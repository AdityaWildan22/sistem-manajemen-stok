<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Models\Stockins;
use App\Models\Stockouts;
use App\Models\User;
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

        return view('dashboard',compact('total_stockin','total_stockout','total_material','total_user'));
    }
}