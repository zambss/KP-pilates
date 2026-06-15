<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'class_id',
        'session_count',
    ];

    /* =====================
       RELATIONS
    ===================== */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassSession::class, 'class_id');
    }
}