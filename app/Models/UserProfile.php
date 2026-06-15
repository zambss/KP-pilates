<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'health_note',
        'emergency_contact',
        'status',
        'avatar'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}
