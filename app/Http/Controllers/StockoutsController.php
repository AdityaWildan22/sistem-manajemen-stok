<?php

namespace App\Http\Controllers;

use App\Exports\StockoutExport;
use App\Http\Requests\StoreStockoutsRequest;
use App\Http\Requests\UpdateStockoutsRequest;
use App\Models\Areas;
use App\Models\DetailStockouts;
use App\Models\drawings;
use App\Models\lines;
use App\Models\Materials;
use App\Models\Stockouts;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StockoutsController extends Controller
{
    protected $view = 'stockout.';
    protected $route = '/stockouts/';
    /**
     * Display a listing of the resource.
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $routes =(object)[
            'index'=> $this->route,
            'add' => $this->route . 'create',
        ];

        $stockout = Stockouts::with('details', 'user','supervisor','enginer')->get();
        return view($this->view.'data',compact('routes','stockout'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route,
            'is_update' => false,
        ];
    
        $materials = Materials::all();
        $areas = Areas::all();
        $drawings = Drawings::all();
        $lines = Lines::all();
    
        $supervisor = User::where('divisi', 'SUPERVISOR')->get();
        $enginer = User::where('divisi', 'ENGINER')->get();
    
        return view($this->view . 'form', compact('routes', 'materials', 'areas', 'drawings', 'lines', 'supervisor','enginer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockoutsRequest $request)
    {

        $filePath = null;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/nota_keluar');
            $filePath = Storage::url($path);
        }

    $stockout = Stockouts::create([
        'no_trans' => $request->no_trans,
        'tgl_keluar' => $request->tgl_keluar,
        'id_user' => Auth::user()->id,
        'id_supervisor' => $request->id_supervisor,
        'id_enginer' => $request->id_enginer,
        'foto' => $filePath,
    ]);

    foreach ($request->details as $detail) {
        // dd($detail);
        DetailStockouts::create([
            'id_stockout' => $stockout->id,
            'id_barang' => $detail['id_barang'],
            'id_area' => $detail['id_area'],
            'id_line' => $detail['id_line'],
            'id_drawing' => $detail['id_drawing'],
            'jumlah' => $detail['jumlah'],
            'satuan' => $detail['satuan']
        ]);

        $material = Materials::find($detail['id_barang']);
        if ($material) {
            $material->decrement('stok', $detail['jumlah']);
        }
    }

    $mess = ["type" => "success", "text" => "Data Berhasil Disimpan"];
    return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stockouts $stockouts, $id)
    {
        $stockout = Stockouts::with('details.material','user','supervisor')->findOrFail($id);
        return view($this->view . 'show', compact('stockout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockouts $stockouts, $id)
    {
        $stockout = Stockouts::findOrFail($id);
        $materials = Materials::all();
        $areas = Areas::All();
        $drawings = drawings::All();
        $lines = lines::All();
        $supervisor = User::where('divisi', 'SUPERVISOR')->get();
        $enginer = User::where('divisi','ENGINER')->get();
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>true,
        ];
        return view($this->view.'form', compact('stockout', 'materials','routes','areas','drawings','lines','supervisor','enginer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockoutsRequest $request, $id)
{
    $stockout = Stockouts::findOrFail($id);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('public/nota_keluar');
        $filePath = Storage::url($path);
    
        if ($stockout->foto) {
            Storage::delete($stockout->foto);
        }

        $stockout->foto = $filePath;
    }

    $stockout->no_trans = $request->no_trans;
    $stockout->tgl_keluar = $request->tgl_keluar;
    $stockout->id_supervisor = $request->id_supervisor;
    $stockout->id_enginer = $request->id_enginer;
    $stockout->save();

    $selisihJumlah = [];
    $deletedDetails = [];

    foreach ($request->details as $key => $detail) {
        if (isset($detail['new'])) {
            $newDetail = DetailStockouts::create([
                'id_stockout' => $stockout->id,
                'id_barang' => $detail['id_barang'],
                'id_area' => $detail['id_area'],
                'id_line' => $detail['id_line'],
                'id_drawing' => $detail['id_drawing'],
                'jumlah' => $detail['jumlah'],
                'satuan' => $detail['satuan']
            ]);

            $material = Materials::findOrFail($detail['id_barang']);
            if ($material) {
                $material->stok -= $detail['jumlah'];
                $material->save();
            }

            continue;
        }

        if (isset($detail['deleted']) && $detail['deleted'] == 'true') {
            $deletedDetails[] = $detail['id'];
            continue;
        }

        $detailId = $detail['id'];
        $detailStockout = DetailStockouts::findOrFail($detailId);

        $selisih = $detail['jumlah'] - $detailStockout->jumlah;
        $selisihJumlah[$detailId] = $selisih;

        $detailStockout->id_barang = $detail['id_barang'];
        $detailStockout->id_area = $detail['id_area'];
        $detailStockout->id_line = $detail['id_line'];
        $detailStockout->id_drawing = $detail['id_drawing'];
        $detailStockout->jumlah = $detail['jumlah'];
        $detailStockout->save();
    }

    foreach ($selisihJumlah as $detailId => $selisih) {
        $detailStockout = DetailStockouts::findOrFail($detailId);

        $material = Materials::findOrFail($detailStockout->id_barang);
        if ($material) {
            $material->stok += $selisih;
            $material->save();
        }
    }

    foreach ($deletedDetails as $detailId) {
        $detailStockout = DetailStockouts::findOrFail($detailId);

        $material = Materials::findOrFail($detailStockout->id_barang);
        if ($material) {
            $material->stok += $detailStockout->jumlah;
            $material->save();
        }

        $detailStockout->delete();
    }

    $mess = ["type" => "success", "text" => "Data Berhasil Dirubah"];
    return redirect($this->route)->with($mess);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stockouts $stockouts, $id)
    {
       $stockout = Stockouts::findOrFail($id);

       foreach ($stockout->details as $detail) {
           $material = Materials::findOrFail($detail->id_barang);
           if ($material) {
               $material->stok -= $detail->jumlah;
               $material->save();
           }
       }

       foreach ($stockout->details as $detail) {
           $detail->delete();
       }

       $stockout->delete();

       $mess = ["type" => "success", "text" => "Data Berhasil Dihapus"];
       return redirect($this->route)->with($mess);
    }

    public function ExportExcel()
    {
        return Excel::download(new StockoutExport, 'Data Stok Keluar.xlsx');
    }

    public function exportPDF()
    {
        $stockout = Stockouts::with('user','details.material', 'details.area', 'details.line', 'details.drawing')->get();
        $pdf = PDF::loadView($this->view.'pdf', compact('stockout'))->setPaper('a4', 'landscape');
        return $pdf->download('Data Stok Keluar.pdf');
        // return view($this->view.'pdf',compact('material'));
          return $pdf->stream();
    }

    public function getDrawings($areaId)
    {
        $drawings = drawings::where('id_area', $areaId)->get();
        return response()->json($drawings);
    }

    public function getLines($drawingId)
    {
        $lines = lines::where('id_drawing', $drawingId)->get();
        return response()->json($lines);
    }
}