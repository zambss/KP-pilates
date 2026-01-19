<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'highlight',
    ];

    public function prices()
    {
        return $this->hasMany(PackagePrice::class);
    }

    public function benefits()
    {
        return $this->hasMany(PackageBenefit::class);
    }
}
