<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'user_uuid', 'name', 'short_desc', 'slug', 'price', 'category_id', 'publish'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailProduct()
    {
        return $this->hasOne(DetailProduct::class);
    }

    public function productPhoto()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productTagMappings()
    {
        return $this->hasMany(ProductTagMapping::class, 'product_id', 'id');
    }
}
