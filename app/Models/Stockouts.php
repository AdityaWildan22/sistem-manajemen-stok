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
        'id_supervisor',
        'id_enginer',
        'foto',
    ];

    public function details()
    {
        return $this->hasMany(DetailStockouts::class,'id_stockout', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'id_supervisor');
    }

    public function enginer()
    {
        return $this->belongsTo(User::class, 'id_enginer');
    }
}