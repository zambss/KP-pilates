<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'label',
        'price',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
