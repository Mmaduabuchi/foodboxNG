<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'discount_type',
        'discount_value',
        'minimum_order_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'per_customer_limit',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'discount_value' => 'decimal:2',
        'minimum_order_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
    ];


    /**
     * Active promo codes.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Promo codes that have not expired.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'active')
                    ->where('starts_at', '<=', now())
                    ->where('expires_at', '>=', now());
    }

    /**
     * All usages of this promo code.
     */
    public function usages()
    {
        return $this->hasMany(PromoCodeUsage::class);
    }

    /**
     * Check if promo code is currently valid.
     */
    public function isValid()
    {
        return $this->status === 'active'
            && now()->between($this->starts_at, $this->expires_at)
            && (is_null($this->usage_limit) || $this->used_count < $this->usage_limit);
    }
}