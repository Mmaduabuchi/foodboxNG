<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPackages extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_packages';

    protected $fillable = [
        'package_id',
        'name',
        'price',
        'image',
        'short_description',
        'description',
        'billing_cycle',
        'status',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];


    // One package can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'sub_package_id');
    }

    // One package can have many items
    public function items()
    {
        return $this->hasMany(PackageItem::class, 'sub_package_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
