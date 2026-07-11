<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code_id',
        'user_id',
        'order_id',
        'discount_amount',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
    ];

    /**
     * Promo code used.
     */
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    /**
     * User who used the promo code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order where the promo code was applied.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}