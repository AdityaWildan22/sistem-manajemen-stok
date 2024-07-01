<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockouts extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'no_trans',
        'tgl_keluar',
        'id_user',
    ];

    public function details()
    {
        return $this->hasMany(DetailStockouts::class,'id_stockout', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}