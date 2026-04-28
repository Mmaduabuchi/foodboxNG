<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    // Status constants
    const STATUS_ACTIVE    = 'active';
    const STATUS_PENDING   = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED    = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    const DELIVERY_PENDING = 'pending';
    const DELIVERY_PROCESSING = 'processing';
    const DELIVERY_OUT_FOR_DELIVERY = 'out_for_delivery';
    const DELIVERY_DELIVERED = 'delivered';
    
    protected $fillable = [
        'user_id',
        'package_id',
        'subscription_id',

        'amount',
        'status',
        'transaction_id',
        'payment_method',

        // subscription context
        'delivery_frequency',
        'delivery_zone',

        // delivery scheduling
        'scheduled_date',
        'delivery_start_time',
        'delivery_end_time',
        'delivery_status',

        'cancelled_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
    ];

    //Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    //Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    //delivery status scopes
    public function scopeDeliveryPending($query)
    {
        return $query->where('delivery_status', self::DELIVERY_PENDING);
    }
    
    public function scopeDeliveryProcessing($query)
    {
        return $query->where('delivery_status', self::DELIVERY_PROCESSING);
    }

    public function scopeOutForDelivery($query)
    {
        return $query->where('delivery_status', self::DELIVERY_OUT_FOR_DELIVERY);
    }

    public function scopeDelivered($query)
    {
        return $query->where('delivery_status', self::DELIVERY_DELIVERED);
    }
}
