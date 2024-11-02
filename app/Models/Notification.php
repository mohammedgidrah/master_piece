<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // protected $table = 'notifications';
    

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        $this->is_read = 1;
        $this->save();
    }

    public function markAsUnread()
    {
        $this->is_read = 0;
        $this->save();
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }
    protected $guarded = [];

    //  protected $fillable = [
    //     'user_id',  // Allows mass assignment for user_id
    //     'type',
    //     'data',
    //     'is_read',
    // ];
}
