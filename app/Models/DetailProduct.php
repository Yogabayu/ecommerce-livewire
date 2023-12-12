<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    protected $table = 'detail_products';
    protected $fillable = [
        'product_id','user_id','spec','long_desc','province_id','city_id','lat','long','type_sales','seeing_count','share_count','pic_wa'
    ];
}
