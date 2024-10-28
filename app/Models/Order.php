<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'customer_id',
        'total_price',
        'order_status',
        'product_id',
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
    public function Allproducts()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price_per_unit', 'total_price'); // Adjust according to your pivot table structure
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
