<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStockouts extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id_stockout',
        'id_barang',
        'id_area',
        'id_line',
        'id_drawing',
        'jumlah',
    ];

    public function stockOut()
    {
        return $this->belongsTo(Stockouts::class,'id_stockout','id');
    }

    public function area()
    {
        return $this->belongsTo(Areas::class,'id_area','id');
    }

    public function line()
    {
        return $this->belongsTo(lines::class,'id_line','id');
    }

    public function drawing()
    {
        return $this->belongsTo(drawings::class,'id_drawing','id');
    }
}