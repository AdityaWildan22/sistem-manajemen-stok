<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStockins extends Model
{
    use HasFactory;

    protected $table = 'detail_stockins';
    // protected $primaryKey = 'id';
    protected $fillable =
    [
        'id_stockin',
        'id_barang',
        'jumlah',
        'satuan',
    ];

    public function stockIn()
    {
        return $this->belongsTo(Stockins::class,'id_stockin','id');
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'id_barang','id');
    }
}