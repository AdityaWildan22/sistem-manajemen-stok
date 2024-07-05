<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    protected $view = 'kategori.';
    protected $route = '/kategoris/';
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
            'save' => $this->route,
            'is_update'=>false,
        ];

        $kategori = Categories::All();
        return view($this->view.'data', compact('routes','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        Categories::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories, $id)
    {
        $kat = Categories::where('id',$id)->first();
        $kategori = Categories::All();
        
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $kat->id,
            'is_update' => true,
        ];

        return view($this->view.'data', compact('kat','kategori','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $categories, $id)
    {
        $kategori = Categories::find($id);
        $kategori->fill($request->all());
        $kategori->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories, $id)
    {
        $kategori = Categories::where('id', $id)->first();
        $kategori->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }
}