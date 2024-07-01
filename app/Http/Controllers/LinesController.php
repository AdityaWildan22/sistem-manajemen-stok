<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorelinesRequest;
use App\Http\Requests\UpdatelinesRequest;
use App\Models\Areas;
use App\Models\lines;

class LinesController extends Controller
{
    protected $view = 'line.';
    protected $route = '/lines/';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object) [
            'index' => $this->route,
            'save' => $this->route,
            'is_update' => false,
        ];

        $line = lines::with('area')->get();
        $area = Areas::all();

        return view($this->view . 'data', compact('routes', 'line', 'area'));
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
    public function store(StorelinesRequest $request)
    {
        // dd($request->all());
        lines::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(lines $lines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lines $lines, $id)
    {
        $lines = lines::with('area')->findOrFail($id); 
        $line = lines::all();
        $area = Areas::all();

    $routes = (object) [
        'index' => $this->route,
        'save' => $this->route . $lines->id, 
        'is_update' => true,
    ];

    return view($this->view . 'data', compact('routes', 'lines', 'line', 'area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelinesRequest $request, lines $lines, $id)
    {
        $line = lines::findOrFail($id);
        $line->fill($request->all());
        $line->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lines $lines, $id)
    {
        $line = lines::findOrFail($id);
        $line->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }
}