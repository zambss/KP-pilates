<?php

namespace App\Models;

use App\Models\PilatesClass;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{

protected $fillable = [
    'class_id',
    'coach_id',   // WAJIB ADA
    'date',
    'start_time',
    'end_time',
    'quota',
     'room', 
];
   

    public function class()
    {
        return $this->belongsTo(PilatesClass::class);
    }
     public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    // (opsional tapi direkomendasikan)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
       public function classs()
    {
        return $this->belongsTo(ClassSession::class, 'class_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}