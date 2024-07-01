<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockinsRequest;
use App\Http\Requests\UpdateStockinsRequest;
use App\Models\DetailStockins;
use App\Models\Materials;
use App\Models\Stockins;

class StockinsController extends Controller
{
    protected $view = 'stockin.';
    protected $route = '/stockins/';
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes =(object)[
            'index'=> $this->route,
            'add' => $this->route . 'create',
        ];

        $stockin = Stockins::with('details', 'user')->get();

        // dd($stockin->$users->all());
        return view($this->view.'data',compact('routes','stockin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>false,
        ];

        $material = Materials::All();
        return view($this->view.'form',compact('routes','material'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockinsRequest $request)
{
    // Simpan data stok masuk
    $stockin = Stockins::create([
        'no_trans' => $request->no_trans,
        'tgl_masuk' => $request->tgl_masuk,
        'id_user' => 1, // Sesuaikan dengan id_user yang sesuai
    ]);

    // Simpan detail stok masuk dan update stok material
    foreach ($request->details as $detail) {
        DetailStockins::create([
            'id_stockin' => $stockin->id,
            'id_barang' => $detail['id_barang'],
            'jumlah' => $detail['jumlah'],
        ]);

        // Update stok di tabel material
        $material = Materials::find($detail['id_barang']);
        if ($material) {
            $material->increment('stok', $detail['jumlah']);
        }
    }

    $mess = ["type" => "success", "text" => "Data Berhasil Disimpan"];
    return redirect($this->route)->with($mess);
}


    /**
     * Display the specified resource.
     */
    public function show(Stockins $stockins, $id)
    {
        $stockIn = Stockins::with('details.material','user')->findOrFail($id);
        return view($this->view . 'show', compact('stockIn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockins $stockins, $id)
    {
        $stockin = Stockins::findOrFail($id);
        $material = Materials::all();
        $routes =(object)[
            'index'=> $this->route,
            'save' => $this->route,
            'is_update'=>true,
        ];
        return view($this->view.'form', compact('stockin', 'material','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockinsRequest $request, $id)
{
    // Temukan stok masuk yang akan diupdate
    $stockin = Stockins::findOrFail($id);

    // Simpan perubahan pada data stok masuk
    $stockin->no_trans = $request->no_trans;
    $stockin->tgl_masuk = $request->tgl_masuk;
    $stockin->save();

    // Array untuk menyimpan selisih jumlah
    $selisihJumlah = [];

    // Array untuk menyimpan ID detail yang dihapus
    $deletedDetails = [];

    // Proses update detail stok masuk
    foreach ($request->details as $key => $detail) {
        // Jika ada 'new' dalam detail, berarti ini detail baru
        if (isset($detail['new'])) {
            $newDetail = DetailStockins::create([
                'id_stockin' => $stockin->id,
                'id_barang' => $detail['id_barang'],
                'jumlah' => $detail['jumlah'],
            ]);

            // Update stok di tabel material
            $material = Materials::findOrFail($detail['id_barang']);
            if ($material) {
                $material->stok += $detail['jumlah'];
                $material->save();
            }

            continue; // Lanjutkan ke iterasi berikutnya
        }

        // Jika detail dihapus, tambahkan ke array deletedDetails dan lanjutkan ke iterasi berikutnya
        if (isset($detail['deleted']) && $detail['deleted'] == 'true') {
            $deletedDetails[] = $detail['id'];
            continue;
        }

        // Jika bukan detail baru, lanjutkan dengan pemrosesan detail yang ada
        $detailId = $detail['id'];
        $detailStockin = DetailStockins::findOrFail($detailId);

        // Hitung selisih jumlah sebelum dan sesudah update
        $selisih = $detail['jumlah'] - $detailStockin->jumlah;
        $selisihJumlah[$detailId] = $selisih;

        // Update detail stok masuk
        $detailStockin->id_barang = $detail['id_barang'];
        $detailStockin->jumlah = $detail['jumlah'];
        $detailStockin->save();
    }

    // Proses pengurangan atau penambahan stok di tabel material berdasarkan selisih jumlah
    foreach ($selisihJumlah as $detailId => $selisih) {
        $detailStockin = DetailStockins::findOrFail($detailId);

        // Update stok di tabel material
        $material = Materials::findOrFail($detailStockin->id_barang);
        if ($material) {
            $material->stok += $selisih;
            $material->save();
        }
    }

    // Proses penghapusan detail stok masuk
    foreach ($deletedDetails as $detailId) {
        $detailStockin = DetailStockins::findOrFail($detailId);

        // Kurangi stok di tabel material
        $material = Materials::findOrFail($detailStockin->id_barang);
        if ($material) {
            $material->stok -= $detailStockin->jumlah;
            $material->save();
        }

        // Hapus detail stok masuk
        $detailStockin->delete();
    }

    // Redirect dengan pesan sukses
    $mess = ["type" => "success", "text" => "Data Berhasil Diupdate"];
    return redirect($this->route)->with($mess);
}
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Temukan stok masuk yang akan dihapus
    $stockin = Stockins::findOrFail($id);

    // Kurangi stok di tabel material berdasarkan detail stok masuk
    foreach ($stockin->details as $detail) {
        $material = Materials::findOrFail($detail->id_barang);
        if ($material) {
            $material->stok -= $detail->jumlah;
            $material->save();
        }
    }

    // Hapus detail stok masuk
    foreach ($stockin->details as $detail) {
        $detail->delete();
    }

    // Hapus stok masuk
    $stockin->delete();

    // Redirect dengan pesan sukses
    $mess = ["type" => "success", "text" => "Data Berhasil Dihapus"];
    return redirect($this->route)->with($mess);
}

}