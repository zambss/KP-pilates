<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilatesClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'coach',
        'date',
        'time',
        'status'
    ];
}
