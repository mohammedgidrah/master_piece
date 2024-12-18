<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'name',
    //     'description',
    //     'image',
    // ];
    protected $guarded = [];
    protected $table = 'categories';


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
