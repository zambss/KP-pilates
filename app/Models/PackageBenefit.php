<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageBenefit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'benefit',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
