@extends('layouts.schedule')

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

            {{-- HEADER ROW --}}
            <div class="empty-cell"></div>
            <div class="day-head">Senin</div>
            <div class="day-head">Selasa</div>
            <div class="day-head">Rabu</div>
            <div class="day-head">Kamis</div>
            <div class="day-head">Jumat</div>
            <div class="day-head">Sabtu</div>

            {{-- ROW 07:00 --}}
            <div class="time-cell">07:00</div>

            <div class="schedule-slot" data-title="Mat Pilates" data-day="Senin" data-time="07:00" data-coach="Sarah"
                data-filled="4" data-capacity="8">
                <div class="class-box">
                    Mat Pilates<br><small>Sarah</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">08:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">09:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">10:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">10:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">11:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">12:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">13:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>

            {{-- ROW 08:00 --}}
            <div class="time-cell">14:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">15:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">16:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">17:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">18:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">19:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- ROW 08:00 --}}
            <div class="time-cell">20:00</div>
            <div class="slot"></div>

            <div class="schedule-slot" data-title="Tower Pilates" data-day="Selasa" data-time="08:00" data-coach="Rina"
                data-filled="6" data-capacity="6">
                <div class="class-box">
                    Tower Pilates<br><small>Rina</small>
                </div>
            </div>

            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            {{-- (slot lain boleh menyusul dengan pola yang sama) --}}

        </div>
    </div>

    {{-- LEGEND --}}
    <div class="schedule-legend">
        <span><i class="dot selected"></i> Kelas Terpilih</span>
        <span><i class="dot available"></i> Tersedia</span>
    </div>

    {{-- ACTION --}}
    <div class="schedule-actions">
        <a href="{{ route('home') }}" class="btn-back">← Kembali</a>
    </div>

</section>

{{-- ======================
     MODAL DETAIL KELAS
====================== --}}
<div id="classModal" class="class-modal">

    <div class="class-modal-overlay"></div>

    <div class="class-modal-card">

        <button id="closeClassModal" class="modal-close">×</button>

        <h3 id="modalTitle">Judul Kelas</h3>
        <p id="modalTime">Hari · Jam</p>

        <div id="modalContent">
            {{-- diisi lewat JS --}}
        </div>

    </div>
</div>


@endsection