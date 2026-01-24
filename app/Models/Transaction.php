<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'user_id',

        // info kelas
        'class_name',
        'coach_name',
        'studio',
        'class_date',
        'start_time',
        'end_time',

        // data peserta
        'participant_name',
        'email',
        'phone',
        'birth_date',
        'address',
        'health_note',
        'emergency_contact',
        'relation',

        // transaksi
        'price',
        'service_fee',
        'total_price',
        'status',

        // pembayaran
        'payment_method',
        'expired_at',
    ];

    /**
     * Cast tipe data otomatis
     */
    protected $casts = [
        'class_date' => 'date',
        'birth_date' => 'date',
        'expired_at' => 'datetime',
    ];

    /**
     * Default value saat create
     */
    protected static function booted()
    {
        static::creating(function ($transaction) {
            // default status
            if (!$transaction->status) {
                $transaction->status = 'pending';
            }

            // default expired 1 jam
            if (!$transaction->expired_at) {
                $transaction->expired_at = Carbon::now()->addHour();
            }
        });
    }

    /* =========================
       RELATIONSHIP
    ========================= */

    // transaksi milik user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* =========================
       HELPER / LOGIC
    ========================= */

    /**
     * Cek apakah transaksi sudah expired
     */
    public function isExpired(): bool
    {
        return $this->status === 'pending'
            && $this->expired_at
            && Carbon::now()->greaterThan($this->expired_at);
    }

    /**
     * Tandai transaksi sebagai paid
     */
    public function markAsPaid($paymentMethod = 'whatsapp')
    {
        $this->update([
            'status' => 'paid',
            'payment_method' => $paymentMethod,
        ]);
    }

    /**
     * Tandai transaksi sebagai expired
     */
    public function markAsExpired()
    {
        $this->update([
            'status' => 'expired',
        ]);
    }
}