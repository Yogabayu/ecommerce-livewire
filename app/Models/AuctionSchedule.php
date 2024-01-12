<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionSchedule extends Model
{
    use HasFactory;
    protected $table = 'auction_schedules';
    protected $fillable = [
        'product_id',
        'category_id',
        'schedule',
        'kpknl',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
