<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'category',
        'description',
        'highlight',
    ];

    public function prices()
    {
        return $this->hasMany(ClassPrice::class, 'class_id');
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'class_id');
    }
      public function packageItems()
    {
        return $this->hasMany(PackageItem::class, 'class_id');
    }
    
}

