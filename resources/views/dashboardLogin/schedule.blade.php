@extends('layouts.dashboard')

@section('content')

<section class="schedule-page">

    {{-- HEADER --}}
    <div class="schedule-header">
        <h1>Pilih Jadwal Kelas</h1>
        <p>Pilih kelas yang ingin Anda ikuti minggu ini</p>
    </div>

    {{-- KALENDER --}}
    <div class="schedule-card">

        <div class="schedule-top">
            <h3>Jadwal Minggu Ini</h3>
            <span>Senin – Sabtu</span>
        </div>

        <div class="schedule-grid">

            {{-- JAM --}}
            <div class="time-col">
                <span>07:00</span>
                <span>08:00</span>
                <span>09:00</span>
                <span>10:00</span>
                <span>11:00</span>
                <span>14:00</span>
                <span>17:00</span>
                <span>18:00</span>
                <span>19:00</span>
            </div>

            {{-- HARI --}}
            <div class="day-col">
                <strong>Senin</strong>
                <div class="class-box">Mat Pilates<br><small>Sarah</small></div>
                <div class="class-box">Reformer<br><small>Maya</small></div>
            </div>

            <div class="day-col">
                <strong>Selasa</strong>
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
                <div class="class-box">Mat Pilates<br><small>Sarah</small></div>
            </div>

            <div class="day-col">
                <strong>Rabu</strong>
                <div class="class-box">Mat Pilates<br><small>Dina</small></div>
                <div class="class-box">Chair Pilates<br><small>Rina</small></div>
            </div>

            <div class="day-col">
                <strong>Kamis</strong>
                <div class="class-box">Tower Pilates<br><small>Maya</small></div>
                <div class="class-box">Mat Pilates<br><small>Dina</small></div>
            </div>

            <div class="day-col">
                <strong>Jumat</strong>
                <div class="class-box">Mat Pilates<br><small>Sarah</small></div>
                <div class="class-box">Chair Pilates<br><small>Maya</small></div>
            </div>

            <div class="day-col">
                <strong>Sabtu</strong>
                <div class="class-box">Reformer<br><small>Sarah</small></div>
                <div class="class-box">Tower Pilates<br><small>Maya</small></div>
            </div>

        </div>

        {{-- LEGEND --}}
        <div class="schedule-legend">
            <span><i class="dot selected"></i> Kelas Terpilih</span>
            <span><i class="dot available"></i> Tersedia</span>
        </div>
    </div>

    {{-- ACTION --}}
    <div class="schedule-actions">
        <a href="{{ route('dashboardLogin.calendar') }}" class="btn-back">← Kembali</a>
        <button class="btn-next">Lanjut ke Formulir →</button>
    </div>

</section>

@endsection