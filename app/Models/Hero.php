<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'members',
        'weekly_classes',
        'image',
    ];
}
