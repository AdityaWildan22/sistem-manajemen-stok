<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nm_cat',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategories::class, 'id_cat', 'id');
    }

    public function material()
    {
        return $this->hasMany(Materials::class, 'id_cat', 'id');
    }
}