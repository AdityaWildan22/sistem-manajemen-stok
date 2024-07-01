<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id_cat',
        'nm_subcat',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'id_cat', 'id');
    }

    public function material()
    {
        return $this->hasMany(Materials::class, 'id_subcat', 'id');
    }
}