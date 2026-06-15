<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageOrderr extends Model
{
     protected $table = 'package_orders';
    protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(Packagee::class, 'package_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}