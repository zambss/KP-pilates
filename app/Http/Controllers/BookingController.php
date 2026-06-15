<?php

namespace App\Http\Controllers;
use App\Models\Classes;

use App\Models\Booking;
use App\Models\ClassSchedule;
use App\Models\ClassSession;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{



public function classes()
{
    $classes = ClassSession::all();
    return view('dashboardLogin.calendar', compact('classes'));
}

public function classDetail(Request $request, ClassSession $class)
{
    // 🔒 BATASI: hanya minggu ini (0) & minggu depan (1)
    $weekOffset = (int) $request->get('week', 0);
    $weekOffset = max(0, min($weekOffset, 1)); // ⬅️ INI KUNCI NYA

    // Senin minggu aktif
    $startDate = now()
        ->startOfWeek(Carbon::MONDAY)
        ->addWeeks($weekOffset);

    // Sabtu minggu aktif
    $endDate = $startDate->copy()->addDays(5);

    $nowDate = now()->toDateString();
    $nowTime = now()->toTimeString();

    // =========================
    // HARI (SENIN–SABTU)
    // =========================
    $weekDays = [];
    for ($i = 0; $i < 6; $i++) {
        $date = $startDate->copy()->addDays($i);
        $weekDays[] = [
            'day_name' => $date->translatedFormat('l'),
            'date'     => $date->translatedFormat('d F Y'),
            'date_key' => $date->toDateString(),
        ];
    }

    // =========================
    // JADWAL (2 MINGGU MAX)
    // =========================
    $schedules = ClassSchedule::with(['bookings', 'coach'])
        ->where('class_id', $class->id)
        ->whereBetween('date', [$startDate, $endDate])
        ->where(function ($q) use ($nowDate, $nowTime) {
            $q->where('date', '>', $nowDate)
              ->orWhere(function ($q) use ($nowDate, $nowTime) {
                  $q->where('date', $nowDate)
                    ->where('start_time', '>', $nowTime);
              });
        })
        ->orderBy('date')
        ->orderBy('start_time')
        ->get()
        ->groupBy('date');

    return view(
        'dashboardLogin.class-detail',
        compact(
            'class',
            'weekDays',
            'schedules',
            'weekOffset',
            'startDate',
            'endDate'
        )
    );
}
    /**
     * 📅 TAMPILAN KALENDER BOOKING (SENIN – SABTU)
     * ❗ KELAS YANG SUDAH LEWAT TIDAK DITAMPILKAN
     */
    public function calendar(Request $request)
    {
        $weekOffset = (int) $request->get('week', 0);

        // Mulai dari SENIN
        $start = Carbon::today()
            ->startOfWeek(Carbon::MONDAY)
            ->addWeeks($weekOffset);

        // Sampai SABTU
        $end = $start->copy()->addDays(5);

        $nowDate = Carbon::today()->toDateString();
        $nowTime = Carbon::now()->toTimeString();

        // ===============================
        // DATA HARI (UNTUK TAB HARI)
        // ===============================
        $weekDays = [];

        for ($i = 0; $i < 6; $i++) {
            $date = $start->copy()->addDays($i);

            $weekDays[] = [
                'day_name' => $date->translatedFormat('l'), // Senin
                'date'     => $date->translatedFormat('d F Y'),
                'date_key' => $date->toDateString(),        // 2026-02-20
            ];
        }

        // ===============================
        // DATA KELAS
        // ===============================
        $schedules = ClassSchedule::with(['class', 'coach', 'bookings'])
            ->whereBetween('date', [$start, $end])
            ->where(function ($q) use ($nowDate, $nowTime) {
                $q->where('date', '>', $nowDate)
                  ->orWhere(function ($q) use ($nowDate, $nowTime) {
                      $q->where('date', $nowDate)
                        ->where('start_time', '>', $nowTime);
                  });
            })
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy('date');

        return view('dashboardLogin.calendar', compact(
            'weekDays',
            'schedules',
            'start',
            'weekOffset'
        ));
    }

    /**
     * ✅ PROSES BOOKING KELAS
     */
 public function store($id)
{
   $userId = Auth::id();

    $schedule = ClassSchedule::with(['bookings', 'class'])
        ->findOrFail($id);

    // ⏰ WAKTU KELAS
    $classDateTime = Carbon::parse(
        $schedule->date . ' ' . $schedule->start_time
    );

    // ❌ KELAS SUDAH LEWAT
    if ($classDateTime->isPast()) {
        return back()->with([
            'booking_popup'   => true,
            'booking_status'  => 'error',
            'booking_message' => 'Kelas ini sudah lewat.'
        ]);
    }

    // ❌ CEK MEMBERSHIP
    $membership = Membership::where('user_id', $userId)
        ->where('class_id', $schedule->class_id)
        ->where('status', 'active')
        ->whereDate('start_date', '<=', now()->toDateString())
        ->whereDate('end_date', '>=', now()->toDateString())
        ->whereColumn('used_sessions', '<', 'total_sessions')
        ->first();

    if (!$membership) {
        return back()->with([
            'booking_popup'   => true,
            'booking_status'  => 'error',
            'booking_message' => 'Anda tidak memiliki card membership aktif.'
        ]);
    }

    // ❌ DOUBLE BOOKING
    $alreadyBooked = Booking::where('user_id', $userId)
        ->where('class_schedule_id', $schedule->id)
        ->whereIn('status', ['booked', 'attended'])
        ->exists();

    if ($alreadyBooked) {
        return back()->with([
            'booking_popup'   => true,
            'booking_status'  => 'error',
            'booking_message' => 'Anda sudah membooking kelas ini.'
        ]);
    }

    // ❌ CEK KUOTA
    $bookedCount = Booking::where('class_schedule_id', $schedule->id)
        ->where('status', 'booked')
        ->count();

    if ($bookedCount >= $schedule->quota) {
        return back()->with([
            'booking_popup'   => true,
            'booking_status'  => 'error',
            'booking_message' => 'Kuota kelas sudah penuh.'
        ]);
    }

    // ✅ SIMPAN BOOKING
    Booking::create([
        'user_id'           => $userId,
        'membership_id'     => $membership->id,
        'class_schedule_id' => $schedule->id,
        'status'            => 'booked',
    ]);

    $membership->increment('used_sessions');

    return back()->with([
        'booking_popup'   => true,
        'booking_status'  => 'success',
        'booking_message' => 'Booking berhasil.'
    ]);
}
    /**
     * ❌ BATAL BOOKING
     */
   public function cancelBooking(Booking $booking)
{
    // 🔒 Pastikan pemilik
    
  if ($booking->user_id !== Auth::id()) { 
        abort(403);
    }

    // ❌ Sudah hadir
    if ($booking->status === 'attended') {
        return back()->with('error', 'Kelas sudah dihadiri.');
    }

    // ❌ Jadwal tidak ada
    if (!$booking->classSchedule) {
        return back()->with('error', 'Jadwal kelas tidak ditemukan.');
    }

    // ❌ Tidak bisa cancel di hari H
    if (Carbon::parse($booking->classSchedule->date)->isToday()) {
        return back()->with('error', 'Kelas hari ini tidak bisa dibatalkan.');
    }

    // 🔁 KEMBALIKAN SESI CARD
    $membership = $booking->membership;

    if ($membership && $booking->status === 'booked') {
        $membership->decrement('used_sessions');
    }

    // 🚫 Update status booking
    $booking->update([
        'status' => 'cancelled',
    ]);

    return back()->with('success', 'Booking dibatalkan & sesi dikembalikan.');
}
}