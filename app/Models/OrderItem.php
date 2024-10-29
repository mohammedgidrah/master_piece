<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

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

// In the OrderItem model
    public function firstOrder()
    {
        return $this->belongsTo(Order::class, 'order_id'); // Assuming 'order_id' is the foreign key
    }
    // In the OrderItem model (OrderItem.php)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id'); // 'order_id' is the foreign key in OrderItem
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
