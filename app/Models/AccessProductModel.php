<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessProductModel extends Model
{
    use HasFactory;
    protected $table = 'access_products';
    protected $fillable = [
        'product_id',
        'hospital',
        'school',
        'bank',
        'market',
        'house_of_worship',
        'cinema',
        'halte',
        'airport',

        'toll',
        'mall',
        'park',
        'pharmacy',
        'restaurant',
        'station',
        'gas_station',

        'others'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
