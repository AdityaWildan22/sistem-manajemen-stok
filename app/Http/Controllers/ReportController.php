<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Models\Stockins;
use App\Models\Stockouts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $view = 'laporan.';
    
    public function index(){
        
        return view($this->view.'index');
    }

    public function rpt_material(){

        $materials = Materials::with('category','subcategories')->get();
        return view($this->view.'laporan_material',compact('materials'));
        
    }

    public function rpt_stockin(){
        $stockins = Stockins::with('user','details.material')->get();
        return view($this->view.'laporan_Stockin',compact('stockins'));
    }

    public function rpt_stockout(){
        $stockouts = Stockouts::with('user','details.material', 'details.area', 'details.line', 'details.drawing')->get();
        return view($this->view.'laporan_Stockout',compact('stockouts'));
    }

    public function rpt_stockin_tanggal(Request $request){

        $tgl_awal = date("Y-m-d", strtotime($request->input("tgl_awal")));
        $tgl_akhir = date("Y-m-d", strtotime($request->input("tgl_akhir")));
    
        $stockins = Stockins::with('user', 'details.material')
            ->where(DB::raw("strftime('%Y-%m-%d', stockins.tgl_masuk)"), '>=', $tgl_awal)
            ->where(DB::raw("strftime('%Y-%m-%d', stockins.tgl_masuk)"), '<=', $tgl_akhir)
            ->get();
    
        return view($this->view . 'laporan_Stockin', compact('stockins'));
    }

    public function rpt_stockout_tanggal(Request $request){

        $tgl_awal = date("Y-m-d", strtotime($request->input("tgl_awal")));
        $tgl_akhir = date("Y-m-d", strtotime($request->input("tgl_akhir")));
    
        $stockouts = Stockouts::with('user', 'details.material')
            ->where(DB::raw("strftime('%Y-%m-%d', stockouts.tgl_keluar)"), '>=', $tgl_awal)
            ->where(DB::raw("strftime('%Y-%m-%d', stockouts.tgl_keluar)"), '<=', $tgl_akhir)
            ->get();
    
        return view($this->view . 'laporan_Stockout', compact('stockouts'));
    }
    
}