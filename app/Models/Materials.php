<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'kd_brg',
        'nm_brg',
        'id_cat',
        'id_subcat',
        'size1',
        'size2',
        'thickness1',
        'thickness2',
        'SCH',
        'type1',
        'type2',
        'satuan',
        'stok',
        'specification',
    ];

    public function stockInDetails()
    {
        return $this->hasMany(DetailStockins::class,'id_barang','id');
    }

    public function stockOutDetails()
    {
        return $this->hasMany(DetailStockouts::class,'id_barang','id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'id_cat', 'id');
    }

    public function subcategories()
    {
        return $this->belongsTo(Subcategories::class, 'id_subcat', 'id');
    }
}