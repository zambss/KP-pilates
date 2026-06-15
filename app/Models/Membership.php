<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'start_date',
        'end_date',
        'total_sessions',
        'used_sessions',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date'
    ];

    /* =====================
       RELATIONS
    ===================== */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }
public function class()
{
    return $this->belongsTo(ClassSession::class, 'class_id');
}

    /* =====================
       ACCESSORS
    ===================== */
    public function getRemainingSessionsAttribute(): int
    {
        return max(0, $this->total_sessions - $this->used_sessions);
    }

    public function getProgressPercentAttribute(): int
    {
        if ($this->total_sessions <= 0) return 0;

        return min(100, round(
            ($this->used_sessions / $this->total_sessions) * 100
        ));
    }

    /* =====================
       STATUS LOGIC
    ===================== */

    /**
     * 🔄 Update status otomatis
     */
    public function refreshStatus(): void
    {
        if (
            $this->used_sessions >= $this->total_sessions ||
            $this->end_date->isPast()
        ) {
            if ($this->status !== 'expired') {
                $this->update(['status' => 'expired']);
            }
        }
    }

    /**
     * ✅ Cek masih aktif
     */
    public function isActive(): bool
    {
        return
            $this->status === 'active' &&
            $this->used_sessions < $this->total_sessions &&
            $this->end_date->isFuture();
    }
}
