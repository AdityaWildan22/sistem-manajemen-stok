<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nm_area',
    ];

    public function lines()
    {
        return $this->hasMany(lines::class,'id_area','id');
    }

    public function drawings()
    {
        return $this->hasMany(drawings::class, 'id_area','id');
    }
}