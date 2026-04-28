<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    
    protected $fillable = [
        'name',
        'price',
        'image',
        'billing_cycle',
        'short_description',
        'description',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // One package can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // One package can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // One package can have many items
    public function items()
    {
        return $this->hasMany(PackageItem::class);
    }
}
