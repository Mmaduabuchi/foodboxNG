<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';

    // Status constants
    const STATUS_PENDING   = 'pending';
    const STATUS_ACTIVE    = 'active';
    const STATUS_PAUSED    = 'paused';
    const STATUS_CANCELLED = 'cancelled';
    
    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'delivery_frequency',
        'delivery_zone',
        'delivery_window',
        'special_notes',
        'next_renewal_date',
        'last_renewal_date',
        'paused_at',
        'cancelled_at',
    ];

    protected $casts = [
        'next_renewal_date' => 'datetime',
        'last_renewal_date' => 'datetime',
        'paused_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    //scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePaused($query)
    {
        return $query->where('status', self::STATUS_PAUSED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }
}
