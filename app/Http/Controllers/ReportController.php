<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Models\Stockins;
use App\Models\Stockouts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $view = 'laporan.';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $supervisor = User::where('divisi', 'SUPERVISOR')->get();
        
        return view($this->view.'index',compact('supervisor'));
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
        $stockouts = Stockouts::with('user','supervisor','enginer','details.material', 'details.area', 'details.line', 'details.drawing')->get();
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

    public function searchSupervisor(Request $request)
    {
        $query = $request->input('query');

        $supervisors = User::where('divisi', 'SUPERVISOR')
                           ->where('name', 'like', "%$query%")
                           ->get(['id', 'name']);

        return response()->json($supervisors);
    }

    public function rpt_stockout_spv(Request $request)
    {
        $supervisor = User::where('divisi', 'SUPERVISOR')->get();
    
        $supervisorId = $request->input('supervisor');
    
        $stockouts = Stockouts::with(['user', 'details.material','supervisor'])
            ->where('id_supervisor', $supervisorId)
            ->get();
    
        return view($this->view . 'laporan_Stockout', compact('stockouts', 'supervisor'));
    }
    
    
}