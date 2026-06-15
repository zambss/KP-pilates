<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'membership_id',
        'class_schedule_id',
        'status'
    ];

    public function schedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
 public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function classSchedule()
{
    return $this->belongsTo(ClassSchedule::class);
}
public function attendance()
{
    return $this->hasOne(Attendance::class);
}
}
