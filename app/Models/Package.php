<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    
    protected $fillable = [
        'name',
        'price',
        'billing_cycle',
        'short_description',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
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
