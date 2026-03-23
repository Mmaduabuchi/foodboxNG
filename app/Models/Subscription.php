<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    
    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'delivery_frequency',
        'delivery_zone',
        'next_renewal_date',
        'last_renewal_date',
        'paused_at',
        'cancelled_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    //get active subscriptions
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    //get paused subscriptions
    public function scopePaused($query)
    {
        return $query->where('status', 'paused');
    }

    //get cancelled subscriptions
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
