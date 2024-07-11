<?php

namespace App\Http\Controllers;

use App\Exports\StockinExport;
use App\Http\Requests\StoreStockinsRequest;
use App\Http\Requests\UpdateStockinsRequest;
use App\Models\DetailStockins;
use App\Models\Materials;
use App\Models\Stockins;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class StockinsController extends Controller
{
    protected $view = 'stockin.';
    protected $route = '/stockins/';
    
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

        $stockin = Stockins::with('details', 'user','enginer')->get();

        // dd($stockin->$users->all());
        return view($this->view.'data',compact('routes','stockin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>false,
        ];

        $material = Materials::All();
        $enginer = User::where('divisi','ENGINER')->get();
        return view($this->view.'form',compact('routes','material','enginer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockinsRequest $request)
    {
        
        $filePath = null;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/nota_masuk');
            $filePath = Storage::url($path);
        }

        $stockin = Stockins::create([
            'no_trans' => $request->no_trans,
            'tgl_masuk' => $request->tgl_masuk,
            'id_user' => Auth::user()->id,
            'id_enginer' => $request->id_enginer,
            'foto' => $filePath,
        ]);

        foreach ($request->details as $detail) {
            DetailStockins::create([
                'id_stockin' => $stockin->id,
                'id_barang' => $detail['id_barang'],
                'jumlah' => $detail['jumlah'],
                'satuan' => $detail['satuan'],
            ]);

            $material = Materials::find($detail['id_barang']);
            if ($material) {
                $material->increment('stok', $detail['jumlah']);
            }
        }

        $mess = ["type" => "success", "text" => "Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }


    /**
     * Display the specified resource.
     */
    public function show(Stockins $stockins, $id)
    {
        $stockIn = Stockins::with('details.material','user','enginer')->findOrFail($id);
        return view($this->view . 'show', compact('stockIn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockins $stockins, $id)
    {
        $stockin = Stockins::findOrFail($id);
        $material = Materials::all();
        $enginer = User::where('divisi','ENGINER')->get();
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>true,
        ];
        return view($this->view.'form', compact('stockin', 'material','routes','enginer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockinsRequest $request, $id)
    {
        $stockin = Stockins::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/nota_masuk');
            $filePath = Storage::url($path);
        
            if ($stockin->foto) {
                Storage::delete($stockin->foto);
            }
    
            $stockin->foto = $filePath;
        }

        $stockin->no_trans = $request->no_trans;
        $stockin->tgl_masuk = $request->tgl_masuk;
        $stockin->id_enginer = $request->id_enginer;
        $stockin->save();

        $selisihJumlah = [];
        $deletedDetails = [];

        foreach ($request->details as $key => $detail) {
            if (isset($detail['new'])) {
                $newDetail = DetailStockins::create([
                    'id_stockin' => $stockin->id,
                    'id_barang' => $detail['id_barang'],
                    'jumlah' => $detail['jumlah'],
                    'satuan' => $detail['satuan']
                ]);

                $material = Materials::findOrFail($detail['id_barang']);
                if ($material) {
                    $material->stok += $detail['jumlah'];
                    $material->save();
                }

                continue;
            }

            if (isset($detail['deleted']) && $detail['deleted'] == 'true') {
                $deletedDetails[] = $detail['id'];
                continue;
            }

            $detailId = $detail['id'];
            $detailStockin = DetailStockins::findOrFail($detailId);

            $selisih = $detail['jumlah'] - $detailStockin->jumlah;
            $selisihJumlah[$detailId] = $selisih;

            $detailStockin->id_barang = $detail['id_barang'];
            $detailStockin->jumlah = $detail['jumlah'];
            $detailStockin->save();
        }

        foreach ($selisihJumlah as $detailId => $selisih) {
            $detailStockin = DetailStockins::findOrFail($detailId);

            $material = Materials::findOrFail($detailStockin->id_barang);
            if ($material) {
                $material->stok += $selisih;
                $material->save();
            }
        }

        foreach ($deletedDetails as $detailId) {
            $detailStockin = DetailStockins::findOrFail($detailId);

            $material = Materials::findOrFail($detailStockin->id_barang);
            if ($material) {
                $material->stok -= $detailStockin->jumlah;
                $material->save();
            }
            $detailStockin->delete();
        }

        $mess = ["type" => "success", "text" => "Data Berhasil Diupdate"];
        return redirect($this->route)->with($mess);
    }
    
    /**
     * Remove the specified resource from storage.
     */
        public function destroy($id)
    {
        $stockin = Stockins::findOrFail($id);

        foreach ($stockin->details as $detail) {
            $material = Materials::findOrFail($detail->id_barang);
            if ($material) {
                $material->stok -= $detail->jumlah;
                $material->save();
            }
        }

        foreach ($stockin->details as $detail) {
            $detail->delete();
        }

        $stockin->delete();

        $mess = ["type" => "success", "text" => "Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }

    public function ExportExcel()
    {
        return Excel::download(new StockinExport, 'Data Stok Masuk.xlsx');
    }

    public function exportPDF()
    {
        $stockin = Stockins::with('user','details.material')->get();
        $pdf = PDF::loadView($this->view.'pdf', compact('stockin'))->setPaper('a4', 'landscape');
        return $pdf->download('Data Stok Masuk.pdf');
        // return view($this->view.'pdf',compact('material'));
          return $pdf->stream();
    }

}