<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\{
    Hero,
    Event,
    Package,
    About,
    Booking,
    ClassOrder,
    Facility,
    Coach,
    Membership,
    UserProfile,
    ClassSchedule,
    ClassSession,
    Packagee,
    PaymentSetting,
    PackageOrderr
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /* =====================
       PUBLIC HOME (LANDING)
    ===================== */

public function home()
{
    $weeklyClasses = ClassSchedule::count();
    $upcomingClass = ClassSchedule::with([
            'class',
            'coach'
        ])
        ->whereDate('date', '>=', now()->toDateString())
        ->orderBy('date')
        ->orderBy('start_time')
        ->first();

    return view('home', [

        'hero' => Hero::first(),
        'weeklyClasses' => $weeklyClasses,
        'upcomingClass' => $upcomingClass,
        'event' => Event::first(),
        'classes' => ClassSession::with('prices')->get(),
        'about' => About::first(),
        'facilities' => Facility::all(),
        'coaches' => Coach::all(),
        'packages' => Packagee::with('items.class')->get(),
    ]);
}
    
    /* =====================
   DASHBOARD HOME
===================== */
public function index()
{
    $user = Auth::user();
    $now  = Carbon::now();

    /* =====================
       KELAS MENDATANG
    ===================== */
    $classes = Booking::with([
            'schedule.class',
            'schedule.coach'
        ])

        ->where('user_id', $user->id)

        ->where('status', 'booked')

        ->whereHas('schedule', function ($q) use ($now) {

            $q->where(function ($query) use ($now) {

                $query

                    ->whereDate(
                        'date',
                        '>',
                        $now->toDateString()
                    )

                    ->orWhere(function ($sub) use ($now) {

                        $sub

                            ->whereDate(
                                'date',
                                $now->toDateString()
                            )

                            ->whereTime(
                                'end_time',
                                '>',
                                $now->toTimeString()
                            );
                    });
            });
        })

        ->orderBy(
            ClassSchedule::select('date')
                ->whereColumn(
                    'class_schedules.id',
                    'bookings.class_schedule_id'
                )
        )

        ->orderBy(
            ClassSchedule::select('start_time')
                ->whereColumn(
                    'class_schedules.id',
                    'bookings.class_schedule_id'
                )
        )

        ->get();


    /* =====================
       MEMBERSHIPS
    ===================== */
    $memberships = Membership::where(
        'user_id',
        $user->id
    )->get();

    // refresh status membership
    $memberships->each->refreshStatus();

    // membership aktif
    $activeMemberships = $memberships
        ->filter
        ->isActive();


    /* =====================
       STATS
    ===================== */
    $activeSessions = $activeMemberships
        ->sum
        ->remaining_sessions;

    $totalPackages = $activeMemberships
        ->count();

    $upcomingClasses = $classes
        ->count();

    $completedSessions = Booking::where(
            'user_id',
            $user->id
        )
        ->where('status', 'attended')
        ->count();


    /* =====================
       PUBLIC SCHEDULES
    ===================== */
    $publicSchedules = ClassSchedule::with([
            'class',
            'coach'
        ])

        ->whereDate(
            'date',
            '>=',
            now()->toDateString()
        )

        ->orderBy('date')

        ->orderBy('start_time')

        ->get()

        ->map(function ($schedule) use ($user) {

            // total booking aktif
            $usedQuota = Booking::where(
                    'class_schedule_id',
                    $schedule->id
                )
                ->where('status', 'booked')
                ->count();

            // cek user sudah booking atau belum
            $alreadyBooked = Booking::where(
                    'class_schedule_id',
                    $schedule->id
                )
                ->where('user_id', $user->id)
                ->where('status', 'booked')
                ->exists();

            // inject data tambahan
            $schedule->used_quota = $usedQuota;

            $schedule->remaining_quota =
                $schedule->quota - $usedQuota;

            $schedule->is_booked = $alreadyBooked;

            return $schedule;
        });


    return view('dashboardLogin.index', compact(
        'classes',
        'activeSessions',
        'totalPackages',
        'upcomingClasses',
        'completedSessions',
        'publicSchedules'
    ));
}

    /* =====================
       DASHBOARD CALENDAR
    ===================== */
    public function calendar(Request $request)
    {
        $currentDate = $request->get('date')
            ? Carbon::parse($request->get('date'))
            : Carbon::now();

        $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::SUNDAY);

        $days = collect();
        for ($i = 0; $i < 7; $i++) {
            $days->push($startOfWeek->copy()->addDays($i));
        }

        return view('dashboardLogin.calendar', compact('days', 'currentDate'));
    }

    /* =====================
       MY CARD
    ===================== */
    public function card()
    {
       $memberships = Membership::with('class')
    ->where('user_id',  Auth::id())
    ->get();


        // 🔄 refresh status sebelum ditampilkan
        $memberships->each->refreshStatus();

        return view('dashboardLogin.my-card', compact('memberships'));
    }

    /* =====================
       OTHER PAGES
    ===================== */
    public function package()
    {
        $payment = PaymentSetting::first();
        return view('dashboardLogin.packages');
    }

   public function notification()
{
    $user = Auth::user();
    $now  = now();

    $notifications = collect();

    /* =====================
       REMINDER KELAS (HARI INI & BESOK)
    ===================== */
    $bookings = Booking::with([
            'schedule.class',
            'schedule.coach'
        ])
        ->where('user_id', $user->id)
        ->where('status', 'booked')
        ->whereHas('schedule', function ($q) use ($now) {
            $q->whereBetween('date', [
                $now->toDateString(),
                $now->copy()->addDay()->toDateString(),
            ]);
        })
        ->get();

    foreach ($bookings as $booking) {
        $schedule = $booking->schedule;

        if (!$schedule || !$schedule->date) {
            continue;
        }

        $notifications->push([
            'type'    => 'class',
            'title'   => 'Reminder Kelas',
            'message' => sprintf(
                'Anda memiliki kelas %s dengan Coach %s pada %s pukul %s',
                $schedule->class?->title ?? '-',
                $schedule->coach?->name ?? '-',
                \Carbon\Carbon::parse($schedule->date)->format('d M Y'),
                $schedule->start_time ?? '-'
            ),
            'date'    => \Carbon\Carbon::parse($schedule->date),
            'unread'  => true,
        ]);
    }

    /* =====================
       CARD AKAN EXPIRED (≤ 21 HARI)
    ===================== */
    $memberships = Membership::with('class')
    ->where('user_id', $user->id)
    ->whereDate('end_date', '>=', now()) // BELUM EXPIRED
    ->get();

foreach ($memberships as $membership) {

    if (!$membership->end_date) {
        continue;
    }

    $daysLeft = now()->diffInDays($membership->end_date, false);

    if ($daysLeft <= 21) {
        $notifications->push([
            'type'    => 'card',
            'title'   => 'Card Akan Segera Berakhir',
            'message' => sprintf(
                'Card %s Anda akan berakhir dalam %d hari (%s).',
                $membership->class?->title ?? '-',
                $daysLeft,
                $membership->end_date->format('d M Y')
            ),
            'date'    => $membership->end_date,
            'unread'  => true,
        ]);
    }
}

    $notifications = $notifications
        ->sortByDesc('date')
        ->values();

    return view('dashboardLogin.notifications', compact('notifications'));
}

    public function profile()
    {
        $user = Auth::user();

        $profile = $user->profile ?? UserProfile::create([
            'user_id' => $user->id
        ]);

        return view('dashboardLogin.profile', compact('user', 'profile'));
    }
      public function transaksi()
{
    $userId =  Auth::id();

    /* =====================
       KELAS BIASA
    ===================== */
    $classOrders = ClassOrder::with('classPrice.class')
        ->where('user_id', $userId)
        ->whereNotNull('class_price_id')
        ->get()
        ->map(function ($order) {
            return [
                'id'        => 'CLS-' . $order->id,
                'type'      => 'Kelas',
                'name'      => $order->classPrice?->class?->title ?? '(Kelas tidak tersedia)',
                'sessions'  => $order->classPrice?->session_count ?? 0,
                'price'     => $order->price,
                'status'    => $order->status,
                'date'      => $order->created_at,
            ];
        });

    /* =====================
       PROMO / PAKET
    ===================== */
    $packageOrders = PackageOrderr::with('package')
        ->where('user_id', $userId)
        ->get()
        ->map(function ($order) {
            return [
                'id'        => 'PKG-' . $order->id,
                'type'      => 'Promo',
                'name'      => $order->package?->name ?? '-',
                'sessions'  => null,
                'price'     => $order->price,
                'status'    => $order->status,
                'date'      => $order->created_at,
            ];
        });

    /* =====================
       GABUNG & URUTKAN
    ===================== */
    $transactions = collect($classOrders)
        ->concat($packageOrders)
        ->sortByDesc('date')
        ->values();
    
        return view('dashboardLogin.transaksi', compact('transactions'));
}

public function updateAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $user = Auth::user();

    $profile = $user->profile;

    if (!$profile) {

        $profile = UserProfile::create([
            'user_id' => $user->id
        ]);
    }

    // hapus lama
    if ($profile->avatar) {

        Storage::disk('public')
            ->delete($profile->avatar);
    }

    // upload baru
    $path = $request->file('avatar')
        ->store('avatars', 'public');

    $profile->update([
        'avatar' => $path
    ]);

    return back()->with(
        'success',
        'Foto profile berhasil diupdate'
    );
}
}