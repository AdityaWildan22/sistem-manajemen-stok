<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lines extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id_area',
        'no_line',
    ];

    public function area()
    {
        return $this->belongsTo(Areas::class,'id_area','id');
    }
}