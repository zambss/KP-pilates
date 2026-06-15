<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassPrice extends Model
{
    protected $fillable = [
    'class_id',
    'session_count',
    'price',
    'bonus_sessions',
];

    public function class()
    {
        return $this->belongsTo(ClassSession::class, 'class_id');
    }
    
}

