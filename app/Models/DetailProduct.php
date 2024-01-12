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
        'gmaps',
        'type_sales',
        'seeing_count',
        'share_count',
        'after_sale',
        'no_pic',
        'sup_doc',

        'surface_area',
        'building_area',
        'bedroom',
        'bathroom',
        'floors',
        'certificate',
        'garage',
        'electrical_power',
        'building_year',

        'chassis_number',
        'machine_number',
        'brand',
        'series',
        'kilometers',
        'cc',

        'type',
        'color',
        'transmission',
        'vehicle_year',
        'date_stnk',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
