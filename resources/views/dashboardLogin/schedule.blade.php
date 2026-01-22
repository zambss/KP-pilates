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

            <!-- HEADER ROW -->
            <div class="empty-cell"></div>
            <div class="day-head">Senin</div>
            <div class="day-head">Selasa</div>
            <div class="day-head">Rabu</div>
            <div class="day-head">Kamis</div>
            <div class="day-head">Jumat</div>
            <div class="day-head">Sabtu</div>

            <!-- ROW 07:00 -->
            <div class="time-cell">07:00</div>
            <div class="slot">
                <div class="class-box">Mat Pilates<br><small>Sarah</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 08:00 -->
            <div class="time-cell">08:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 09:00 -->
            <div class="time-cell">09:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 10:00 -->
            <div class="time-cell">10:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 11:00 -->
            <div class="time-cell">11:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 12:00 -->
            <div class="time-cell">12:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 13:00 -->
            <div class="time-cell">13:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 14:00 -->
            <div class="time-cell">14:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 15:00 -->
            <div class="time-cell">15:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 16:00 -->
            <div class="time-cell">16:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 17:00 -->
            <div class="time-cell">17:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 18:00 -->
            <div class="time-cell">18:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            <!-- ROW 19:00 -->
            <div class="time-cell">19:00</div>
            <div class="slot"></div>
            <div class="slot">
                <div class="class-box">Tower Pilates<br><small>Rina</small></div>
            </div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

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