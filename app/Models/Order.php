<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_price',
        'order_status',
        'shipping_address'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // public function payment()
    // {
    //     return $this->hasOne(Payment::class);
    // }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
