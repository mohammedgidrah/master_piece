<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'quantity',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // public function orderItems()
    // {
    //     return $this->belongsToMany(Order::class, 'order_items')
    //                 ->withPivot('quantity', 'price_per_unit', 'total_price');
    // }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
