<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategoriesRequest;
use App\Http\Requests\UpdateSubcategoriesRequest;
use App\Models\Categories;
use App\Models\Subcategories;

class SubcategoriesController extends Controller
{
    protected $view = 'subkategori.';
    protected $route = '/subkategoris/';

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

        $subkategori = Subcategories::with('category')->get();
        $kategori = Categories::all();

        return view($this->view . 'data', compact('routes', 'subkategori', 'kategori'));
    }

    public function create()
    {
        //
    }

    public function store(StoreSubcategoriesRequest $request)
    {
        Subcategories::create($request->all());
        $mess = ["type"=>"success","text"=>"Data Berhasil Disimpan"];
        return redirect($this->route)->with($mess);
    }

    public function show(Subcategories $subcategories)
    {
        // Method for displaying a specific subcategory
    }

    public function edit($id)
    {
        $subcat = Subcategories::with('category')->findOrFail($id);
        $subkategori = Subcategories::all();
        $kategori = Categories::all();

    $routes = (object) [
        'index' => $this->route,
        'save' => $this->route . $subcat->id,
        'is_update' => true,
    ];

    return view($this->view . 'data', compact('routes', 'kategori', 'subkategori', 'subcat'));
    }

    public function update(UpdateSubcategoriesRequest $request, $id)
    {
        $subkategori = Subcategories::findOrFail($id);
        $subkategori->fill($request->all());
        $subkategori->save();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dirubah"];
        return redirect($this->route)->with($mess);
    }

    public function destroy($id)
    {
        $subkategori = Subcategories::findOrFail($id);
        $subkategori->delete();
        $mess = ["type"=>"success","text"=>"Data Berhasil Dihapus"];
        return redirect($this->route)->with($mess);
    }
}