<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'packages';

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_DRAFT = 'draft';
    
    protected $fillable = [
        'name',
        'price',
        'image',
        'billing_cycle',
        'short_description',
        'description',
        'status',
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

    //Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }
}