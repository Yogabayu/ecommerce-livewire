<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    protected $table = 'detail_products';
    protected $fillable = [
        'product_id',
        'address',
        'long_desc',
        'province_code',
        'city_code',
        'lat',
        'long',
        'gmaps',
        'surface_area',
        'building_area',
        'sup_doc',
        'type_sales',
        'seeing_count',
        'share_count',
        'no_pic',
        'after_sale'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
