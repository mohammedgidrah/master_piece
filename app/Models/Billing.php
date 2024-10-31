<?php
namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'order_id',
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone',
    //     'order_status',
    //     'billing_city',
    //     'billing_address',
        
    // ];
    protected $guarded = [];

    // Define a relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a relationship to the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
