<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $table = 'package_items';

    protected $fillable = [
        'package_id',
        'item_name',
        'quantity',
        'unit',
        'estimated_price',
    ];

    // One package item belongs to one package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
