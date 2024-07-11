<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Categories;
use App\Models\drawings;
use App\Models\lines;
use App\Models\Materials;
use App\Models\Stockins;
use App\Models\Stockouts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_stockin = Stockins::count();
        $total_stockout = Stockouts::count();
        $total_material = Materials::count();
        $total_user = User::count();
        $total_kategori = Categories::count();
        $total_area = Areas::count();
        $total_drawing = drawings::count();
        $total_line = lines::count();

        $today = Carbon::today();
        $stockin_today = Stockins::with('user')->whereDate('tgl_masuk', $today)->get();
        $stockout_today = Stockouts::with('user','supervisor')->whereDate('tgl_keluar', $today)->get();

        return view('dashboard',compact('total_stockin','total_stockout','total_material','total_user','total_kategori','total_area','total_drawing','total_line','stockin_today','stockout_today'));
    }
}