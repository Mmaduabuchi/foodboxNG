<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SubPackages extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_packages';

    protected $fillable = [
        'package_id',
        'name',
        'slug',
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($subPackage) {
            if (empty($subPackage->slug)) {
                $subPackage->slug = Str::slug($subPackage->name);
            }
        });
    }
    
    public function getDisplayDescriptionAttribute(): string
    {
        $description = trim($this->short_description ?? '');

        if ($description === '') {
            $description = $this->description ?? '';
        }

        return Str::limit($description, 100);
    }

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

    // One sub package can have many orders
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'sub_package_id');
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
