@extends('layouts.dashboard')

@section('content')

{{-- =========================
   HEADER
========================= --}}
<div class="class-detail-header">

    <div>

        <h1>
            {{ $class->title }}
        </h1>

        <p>
            {{ $startDate->translatedFormat('d F') }}
            —
            {{ $endDate->translatedFormat('d F Y') }}
        </p>

    </div>

    <a href="{{ route('dashboardLogin.calendar') }}" class="back-btn">

        ← Kembali

    </a>

</div>



{{-- =========================
   WEEK NAVIGATION
========================= --}}
<div class="week-navigation">

    {{-- PREV --}}
    @if($weekOffset > 0)

    <a href="{{ route('dashboard.classes.detail', [$class->id, 'week' => $weekOffset - 1]) }}" class="week-button">

        ← Minggu Ini

    </a>

    @else

    <span class="week-button disabled">

        ← Minggu Ini

    </span>

    @endif



    {{-- NEXT --}}
    @if($weekOffset < 1) <a href="{{ route('dashboard.classes.detail', [$class->id, 'week' => $weekOffset + 1]) }}"
        class="week-button active">

        Minggu Depan →

        </a>

        @else

        <span class="week-button disabled">

            Minggu Depan →

        </span>

        @endif

</div>



{{-- =========================
   DATE SLIDER
========================= --}}
<div class="date-slider-wrapper">

    <div class="date-slider">

        @foreach($weekDays as $index => $day)

        <button class="date-item {{ $index === 0 ? 'active' : '' }}" data-date="{{ $day['date_key'] }}">

            <span class="date-day">
                {{ \Carbon\Carbon::parse($day['date_key'])->translatedFormat('D') }}
            </span>

            <span class="date-number">
                {{ \Carbon\Carbon::parse($day['date_key'])->format('d') }}
            </span>

        </button>

        @endforeach

    </div>

</div>



{{-- =========================
   CONTENT
========================= --}}
@foreach($weekDays as $index => $day)

@php
$dateKey = $day['date_key'];
$items = $schedules[$dateKey] ?? collect();
@endphp

<div class="date-content" id="date-{{ $dateKey }}" style="{{ $index === 0 ? '' : 'display:none' }}">

    <h3 class="content-date-title">

        {{ \Carbon\Carbon::parse($dateKey)->translatedFormat('l, d F Y') }}

    </h3>



    @forelse($items as $schedule)

    @php

    $booked = $schedule->bookings
    ->where('status', 'booked')
    ->count();

    $full = $booked >= $schedule->quota;

    $classDateTime = \Carbon\Carbon::parse(
    $schedule->date . ' ' . $schedule->start_time
    );

    if ($classDateTime->isPast()) continue;

    $disableBooking =
    now()->diffInHours($classDateTime, false) <= 12; $start=\Carbon\Carbon::parse($schedule->start_time);

        $end = \Carbon\Carbon::parse($schedule->end_time);

        $duration = $start->diffInMinutes($end);

        @endphp



        <div class="schedule-card {{ ($full || $disableBooking) ? 'disabled' : '' }}">

            {{-- LEFT --}}
            <div class="schedule-left">

                <div class="schedule-time">

                    {{ $start->format('H:i') }}
                    —
                    {{ $end->format('H:i') }}

                </div>

                <div class="schedule-duration">

                    ⏱️ {{ $duration }} menit

                </div>

                <div class="schedule-meta">

                    <span>
                        Coach:
                        {{ $schedule->coach->name ?? '-' }}
                    </span>

                    <span>
                        Studio:
                        {{ $schedule->room ?? '-' }}
                    </span>

                    <span>
                        👥 {{ $booked }} / {{ $schedule->quota }} Slot
                    </span>

                </div>

            </div>



            {{-- RIGHT --}}
            <div class="schedule-right">

                @if($full)

                <span class="status-badge full">

                    FULL

                </span>

                @elseif($disableBooking)

                <span class="status-badge closed">

                    CLOSED

                </span>

                @else

                <form method="POST" action="{{ route('booking.store', $schedule->id) }}">

                    @csrf

                    <button class="booking-btn">

                        Booking

                    </button>

                </form>

                @endif

            </div>

        </div>

        @empty

        <div class="empty-schedule">

            Tidak ada jadwal di tanggal ini

        </div>

        @endforelse

</div>

@endforeach




{{-- =========================
   STYLE
========================= --}}
<style>
/* =========================
   HEADER
========================= */

.class-detail-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 24px;
}

.class-detail-header h1 {
    font-size: 30px;
    font-weight: 500;
    color: #2f2f2f;
    margin-bottom: 6px;
}

.class-detail-header p {
    color: #8b8b8b;
    font-size: 14px;
}

.back-btn {
    padding: 10px 16px;
    border-radius: 14px;
    background: #f3f3f3;
    text-decoration: none;
    color: #2f2f2f;
    font-size: 13px;
    transition: .2s;
}

.back-btn:hover {
    background: #e7e7e7;
}


/* =========================
   WEEK NAV
========================= */

.week-navigation {
    display: flex;
    justify-content: space-between;
    margin-bottom: 24px;
}

.week-button {
    padding: 10px 16px;
    border-radius: 14px;
    background: #efefef;
    text-decoration: none;
    color: #2f2f2f;
    font-size: 13px;
}

.week-button.active {
    background: #2f2f2f;
    color: #fff;
}

.week-button.disabled {
    opacity: .4;
    pointer-events: none;
}


/* =========================
   DATE SLIDER
========================= */

.date-slider-wrapper {
    overflow-x: auto;
    margin-bottom: 28px;
}

.date-slider {
    display: flex;
    gap: 12px;
    min-width: max-content;
}

.date-item {
    width: 72px;
    height: 72px;
    border: none;
    border-radius: 22px;
    background: #f5f5f5;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: .2s;
}

.date-item.active {
    background: #2f2f2f;
}

.date-day {
    font-size: 11px;
    color: #8b8b8b;
}

.date-number {
    font-size: 20px;
    font-weight: 500;
    color: #2f2f2f;
}

.date-item.active .date-day,
.date-item.active .date-number {
    color: #fff;
}


/* =========================
   CONTENT
========================= */

.content-date-title {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 18px;
    color: #2f2f2f;
}


/* =========================
   CARD
========================= */

.schedule-card {
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 24px;
    padding: 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 16px;
    transition: .2s;
}

.schedule-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.schedule-card.disabled {
    opacity: .7;
}


/* =========================
   LEFT
========================= */

.schedule-time {
    font-size: 22px;
    font-weight: 400;
    color: #2f2f2f;
    margin-bottom: 6px;
}

.schedule-duration {
    font-size: 13px;
    color: #8b8b8b;
    margin-bottom: 14px;
}

.schedule-meta {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.schedule-meta span {
    font-size: 13px;
    color: #5f5f5f;
}


/* =========================
   BUTTON
========================= */

.booking-btn {
    border: none;
    padding: 12px 22px;
    border-radius: 999px;
    background: #2f2f2f;
    color: #fff;
    cursor: pointer;
    font-size: 13px;
    transition: .2s;
}

.booking-btn:hover {
    opacity: .9;
}


/* =========================
   STATUS
========================= */

.status-badge {
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge.full {
    background: #ffe5e5;
    color: #c0392b;
}

.status-badge.closed {
    background: #ececec;
    color: #666;
}


/* =========================
   EMPTY
========================= */

.empty-schedule {
    padding: 20px;
    border-radius: 18px;
    background: #f8f8f8;
    color: #777;
    font-size: 14px;
}


/* =========================
   MOBILE
========================= */

@media(max-width:768px) {

    .class-detail-header {
        flex-direction: column;
    }

    .schedule-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .schedule-right {
        width: 100%;
    }

    .booking-btn {
        width: 100%;
    }

}
</style>

@endsection