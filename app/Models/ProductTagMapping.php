<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTagMapping extends Model
{
    use HasFactory;
    protected $table = 'product_tag_mappings';
    protected $fillable = ['product_id','tag_id'];
}
