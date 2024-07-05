<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredrawingsRequest;
use App\Http\Requests\UpdatedrawingsRequest;
use App\Models\Areas;
use App\Models\drawings;

class DrawingsController extends Controller
{
    protected $view = 'drawing.';
    protected $route = '/drawings/';
    /**
     * Display a listing of the resource.
     */
    
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $routes = (object) [
            'index' => $this->route,
            'save' => $this->route,
            'is_update' => false,
        ];

        $drawing = drawings::with('area')->get();
        $area = Areas::all();

        return view($this->view . 'data', compact('routes', 'drawing', 'area'));
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
    public function store(StoredrawingsRequest $request)
    {
        // dd($request->all());
        drawings::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(drawings $drawings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(drawings $drawings, $id)
    {
        $drawings = drawings::with('area')->findOrFail($id); 
        $drawing = drawings::all();
        $area = Areas::all();

        $routes = (object) [
            'index' => $this->route,
            'save' => $this->route . $drawings->id, 
            'is_update' => true,
        ];

    return view($this->view . 'data', compact('routes', 'drawings', 'drawing', 'area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedrawingsRequest $request, drawings $drawings, $id)
    {
        $drawing = drawings::findOrFail($id);
        $drawing->fill($request->all());
        $drawing->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(drawings $drawings, $id)
    {
        $drawing = drawings::findOrFail($id);
        $drawing->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }
}