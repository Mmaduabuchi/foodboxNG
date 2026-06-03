<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $table = 'package_items';

    protected $fillable = [
        'sub_package_id',
        'item_name',
        'quantity',
        'unit',
        'estimated_price',
    ];

    // One or more sub package item belongs to one sub package
    public function subPackages()
    {
        return $this->belongsTo(SubPackages::class, 'sub_package_id');
    }
}
