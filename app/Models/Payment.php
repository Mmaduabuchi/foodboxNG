<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    //
    use HasFactory;

    const STATUS_PENDING  = 'pending';
    const STATUS_SUCCESS  = 'success';
    const STATUS_FAILED   = 'failed';
    const STATUS_REFUNDED = 'refunded';

    protected $fillable = [
        'user_id',
        'order_id',
        'subscription_id',
        'amount',
        'currency',
        'transaction_reference',
        'gateway_reference',
        'payment_method',
        'status',
        'gateway',
        'meta',
        'paid_at',
    ];  

    protected $casts = [
        'amount' => 'decimal:2',
        'meta' => 'array',
        'paid_at' => 'datetime',
    ];  

    //Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    //Scopes
    public function scopeSuccessful($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', self::STATUS_REFUNDED);
    }
}
