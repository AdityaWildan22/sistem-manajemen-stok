<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockins extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'no_trans',
        'tgl_masuk',
        'id_user',
    ];

    public function details()
    {
        return $this->hasMany(DetailStockins::class, 'id_stockin', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}