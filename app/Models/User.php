<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone',
    //     'address',
    //     'password',
    //     'image',
    //     'role',
    //     'social_id',
    //     'social_type',
    // ];
    protected $guarded = [];
    public function isAdmin()
    {
        return $this->role === 'admin'; // or however you define admin roles
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id'); // Make sure 'customer_id' is the correct foreign key
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }
    

}
