<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable; // <-- tambahkan ini

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'role',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // =====================
    // ROLE CHECKER
    // =====================

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}