<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packagee extends Model
{
     protected $table = 'packages';
    protected $fillable = [
        'name',
        'price',
        'is_active',
    ];

    /* =====================
       RELATIONS
    ===================== */
     public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    
    public function items()
    {
        return $this->hasMany(PackageItem::class, 'package_id');
    }

    public function orders()
    {
        return $this->hasMany(ClassOrder::class, 'package_id');
    }
}