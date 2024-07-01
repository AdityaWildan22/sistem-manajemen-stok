<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Http\Requests\StoreAreasRequest;
use App\Http\Requests\UpdateAreasRequest;

class AreasController extends Controller
{
    protected $view = 'area.';
    protected $route = '/areas/';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>false,
        ];

        $area = Areas::All();
        return view($this->view.'data', compact('routes','area'));
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
    public function store(StoreAreasRequest $request)
    {
        // dd($request->all());
        Areas::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(Areas $areas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Areas $areas, $id)
    {
        $areas = Areas::where('id',$id)->first();
        $area = Areas::All();
        
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $areas->id,
            'is_update' => true,
        ];

        return view($this->view.'data', compact('areas','area','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreasRequest $request, Areas $areas, $id)
    {
        $area = Areas::find($id);
        $area->fill($request->all());
        $area->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Areas $areas, $id)
    {
        $area = Areas::where('id', $id)->first();
        $area->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }
}