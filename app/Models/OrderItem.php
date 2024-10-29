<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

// In OrderItem.php
protected $fillable = [
    'user_id',
    'product_id',
    'order_id',
    'order_status',
    'quantity',
    'price_per_unit',
    'total_price', // Add total_price to fillable properties
];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
