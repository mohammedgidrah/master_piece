<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // 'id',
        'customer_id', 
        'total_price', 
        'order_status', 
        'product_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

 
    public function product()
{
    return $this->belongsTo(Product::class);
}

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
