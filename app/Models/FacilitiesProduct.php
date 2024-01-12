<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesProduct extends Model
{
    use HasFactory;
    protected $table = 'facilities_tables';
    protected $fillable = [
        'product_id',
        'furnished',
        'swimming_pool',
        'lift',
        'gym',
        'carport',
        'telephone',
        'security',
        'garage',
        'park',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
