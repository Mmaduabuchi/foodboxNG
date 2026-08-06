<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';
    
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'icon',
        'url',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    //Notification belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
