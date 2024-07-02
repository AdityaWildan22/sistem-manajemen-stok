<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DrawingsController;
use App\Http\Controllers\LinesController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\StockinsController;
use App\Http\Controllers\StockoutsController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('layouts.template');
});

Route::get('/material', function () {
    return view('material.data');
});

// Route Kategori
Route::resource('kategoris',CategoriesController::class);

// Route Sub Kategori
Route::resource('subkategoris',SubcategoriesController::class);

// Route Area
Route::resource('areas',AreasController::class);

// Route Line
Route::resource('lines',LinesController::class);

// Route Drawing
Route::resource('drawings',DrawingsController::class);

// Route User
Route::resource('users',UserController::class);

// Route Material
Route::resource('materials',MaterialsController::class);
Route::get('/material/search', [MaterialsController::class, 'search'])->name('material.search');
Route::get('/material/search2', [MaterialsController::class, 'search2'])->name('material.search2');
Route::get('material/export-excel', [MaterialsController::class, 'exportExcel']);
Route::get('material/export-pdf', [MaterialsController::class, 'exportPDF']);

// Route Stockin
Route::resource('stockins',StockinsController::class);
Route::get('stockin/export-excel', [StockinsController::class, 'ExportExcel']);
Route::get('stockin/export-pdf', [StockinsController::class, 'exportPDF']);

// Route Stockout
Route::resource('stockouts',StockoutsController::class);
Route::get('stockout/export-excel', [StockoutsController::class, 'ExportExcel']);
Route::get('stockout/export-pdf', [StockoutsController::class, 'exportPDF']);