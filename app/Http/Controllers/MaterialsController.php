<?php

namespace App\Http\Controllers;

use App\Exports\MaterialExport;
use App\Http\Requests\StoreMaterialsRequest;
use App\Http\Requests\UpdateMaterialsRequest;
use App\Models\Categories;
use App\Models\Materials;
use App\Models\Subcategories;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class MaterialsController extends Controller
{
    protected $view = 'material.';
    protected $route = '/materials/';
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

        $material = Materials::with('category','subcategories')->get();
        return view($this->view.'data',compact('routes','material'));
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

        $kategori = Categories::All();
        $subkat   = Subcategories::All();
        return view($this->view.'form',compact('routes','kategori','subkat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialsRequest $request)
    {
        // dd($request->all());
        Materials::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(Materials $materials, $id)
    {
        $material = Materials::with('category','subcategories')->where('id',$id)->first();
        return view($this->view.'show',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materials $materials, $id)
    {
        $materials = Materials::with('category','subcategories')->where('id',$id)->first();
        // dd($materials);
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $materials->id,
            'is_update' => true,
        ];
        $kategori = Categories::All();
        $subkat   = Subcategories::All();
        return view($this->view.'form',compact('routes','materials','kategori','subkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialsRequest $request, Materials $materials, $id)
    {
        $material = Materials::findOrFail($id);
        $material->fill($request->all());
        $material->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materials $materials, $id)
    {
        $material = Materials::findOrFail($id);
        $material->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $kategoris = Categories::where('nm_cat', 'LIKE', "%{$query}%")->get();
        return response()->json($kategoris);
    }

    public function search2(Request $request)
    {
        $query = $request->get('query');
        $subkat = Subcategories::where('nm_subcat', 'LIKE', "%{$query}%")->get();
        return response()->json($subkat);
    }

    public function exportExcel()
    {
        return Excel::download(new MaterialExport, 'Data Material.xlsx');
    }

    public function exportPDF()
    {
        $material = Materials::with('category','subcategories')->get();
        $pdf = PDF::loadView($this->view.'pdf', compact('material'))->setPaper('a4', 'landscape');
        // return $pdf->download('Data Material.pdf');
        // return view($this->view.'pdf',compact('material'));
          return $pdf->stream();
    }
}