@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<div class="dashboard-header">
    <h1>Kalender & Jadwal Kelas</h1>
    <p>Kelola jadwal dan booking kelas Anda (maksimal 2 minggu ke depan)</p>
</div>

<!-- REMINDER KELAS -->
<section class="section reminder-section">
    <h3>Reminder Kelas Mendatang</h3>

    <div class="reminder-card">
        <div class="reminder-info">
            <strong>Yoga Flow</strong>
            <small>Selasa, 20 Januari 2026 · 18:00 - 19:00</small>
        </div>
        <span class="badge confirmed">Confirmed</span>
    </div>

    <div class="reminder-card">
        <div class="reminder-info">
            <strong>Reformer Pilates</strong>
            <small>Rabu, 21 Januari 2026 · 09:00 - 10:00</small>
        </div>
        <span class="badge confirmed">Confirmed</span>
    </div>

    <div class="reminder-card">
        <div class="reminder-info">
            <strong>Mat Pilates</strong>
            <small>Jumat, 23 Januari 2026 · 10:30 - 11:30</small>
        </div>
        <span class="badge confirmed">Confirmed</span>
    </div>
</section>

<!-- KALENDER MINGGUAN -->
<section class="section calendar-section">
    <div class="calendar-header">
        <div>
            <h3>Kalender Mingguan</h3>
            <p>
                {{ $days->first()->translatedFormat('d M') }}
                –
                {{ $days->last()->translatedFormat('d M Y') }}
            </p>
        </div>
        <div class="calendar-nav">
            <button>&larr;</button>
            <button class="today-btn">Hari Ini</button>
            <a href="{{ route('dashboard.schedule') }}" class="calendar-arrow">
                &rarr;
            </a>

        </div>
    </div>

    <div class="calendar-grid">
        @foreach ($days as $day)
        <div class="calendar-day">
            <strong>{{ strtoupper($day->translatedFormat('D')) }}</strong>
            <h4>{{ $day->format('d') }}</h4>
            <small>Klik untuk booking</small>
        </div>
        @endforeach
    </div>

</section>

@endsection