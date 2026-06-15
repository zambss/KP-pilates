@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

@auth
<div class="dashboard-header">

    <h1>
        Selamat Datang,
        {{ auth()->user()->name }}!
    </h1>

    <p>
        Member sejak
        {{ auth()->user()->created_at->translatedFormat('d M Y') }}
    </p>

</div>
@endauth


<!-- ================= STAT ================= -->
<div class="stats-grid">

    <div class="stat-card stat-success">
        <span>Total Sesi Aktif</span>

        <h2>{{ $activeSessions }}</h2>

        <small>
            Dari {{ $totalPackages }} Paket
        </small>
    </div>

    <div class="stat-card stat-warning">
        <span>Kelas Mendatang</span>

        <h2>{{ $upcomingClasses }}</h2>

        <small>
            Sudah Terjadwal
        </small>
    </div>

    <div class="stat-card stat-neutral">
        <span>Total Sesi Diikuti</span>

        <h2>{{ $completedSessions }}</h2>

        <small>
            Total sesi diikuti
        </small>
    </div>

</div>


<!-- ================= UPCOMING CLASS ================= -->
<section class="section">

    <div class="section-header">

        <h3>
            Kelas Mendatang
        </h3>

        <a href="#">
            Lihat Semua
        </a>

    </div>

    @forelse ($classes as $booking)

    <div class="class-card">

        <div>

            <strong>
                {{ $booking->schedule->class->title }}
            </strong>

            <p>
                Coach
                {{ $booking->schedule->coach->name }}
            </p>

            <small>
                {{ \Carbon\Carbon::parse($booking->schedule->date)
                    ->translatedFormat('d M Y') }}

                ·

                {{ substr($booking->schedule->start_time, 0, 5) }}
                -

                {{ substr($booking->schedule->end_time, 0, 5) }}
            </small>

        </div>

        <div class="class-action">

            <span class="badge paid {{ $booking->status }}">
                {{ ucfirst($booking->status) }}
            </span>

            @if ($booking->status === 'booked')

            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin membatalkan kelas ini?')">
                @csrf

                <button type="submit" class="btn-cancel">
                    Cancel
                </button>

            </form>

            @endif

        </div>

    </div>

    @empty

    <p class="empty-text">
        Belum ada kelas mendatang
    </p>

    @endforelse

</section>


<!-- ================= PUBLIC SCHEDULE ================= -->
<section class="section">

    <div class="section-header">

        <div>
            <h3>Jadwal Kelas</h3>

            @if($totalPackages > 0)

            <small>
                Pilih kelas yang tersedia
            </small>

            @else

            <small style="color:#dc3545;">
                Anda belum memiliki card aktif
            </small>

            @endif
        </div>

    </div>


    <div class="public-schedule-grid">

        @forelse($publicSchedules as $schedule)

        <div class="public-schedule-card">

            <!-- STATUS -->
            <div class="schedule-badge-group">

                @if($schedule->remaining_quota <= 0) <span class="badge-full">
                    FULL
                    </span>

                    @elseif(!$schedule->is_open)

                    <span class="badge-closed">
                        CLOSED
                    </span>

                    @else

                    <span class="badge-open">
                        OPEN
                    </span>

                    @endif

            </div>


            <!-- TITLE -->
            <h4>
                {{ $schedule->class->title }}
            </h4>


            <!-- INFO -->
            <div class="schedule-info">

                <p>
                    {{ \Carbon\Carbon::parse($schedule->date)
                        ->translatedFormat('l, d F Y') }}
                </p>

                <p>
                    {{ substr($schedule->start_time,0,5) }}
                    -
                    {{ substr($schedule->end_time,0,5) }}
                </p>

                <p>
                    Coach:
                    {{ $schedule->coach->name }}
                </p>

                <p>
                    Studio:
                    {{ $schedule->room }}
                </p>

                <p>
                    Kuota:
                    {{ $schedule->quota }}
                </p>

                <p class="schedule-quota">
                    Sisa Slot:
                    {{ $schedule->remaining_quota }}
                </p>

            </div>


            <!-- BUTTON -->
            @if($totalPackages > 0)

            {{-- SUDAH BOOKING --}}
            @if($schedule->is_booked)

            <button class="btn-booking-disabled" disabled>
                Sudah Dibooking
            </button>

            {{-- FULL --}}
            @elseif($schedule->remaining_quota <= 0) <button class="btn-booking-disabled" disabled>
                Class Full
                </button>

                {{-- CLOSED --}}
                @elseif(!$schedule->is_open)

                <button class="btn-booking-disabled" disabled>
                    Class Closed
                </button>

                {{-- OPEN --}}
                @else

                <form action="{{ route('dashboard.schedule.booking', $schedule->id) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn-booking">
                        Booking Kelas
                    </button>

                </form>

                @endif

                @else

                <button class="btn-booking-disabled" disabled>
                    Card Tidak Aktif
                </button>

                @endif

        </div>

        @empty

        <p class="empty-text">
            Belum ada jadwal tersedia
        </p>

        @endforelse

    </div>

</section>

@endsection