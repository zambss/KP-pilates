@extends('layouts.admin')

@section('title', 'Jadwal')

@section('content')

<div class="jadwal-wrapper">

    {{-- HEADER --}}
    <div class="jadwal-header">

        <div class="header-left">
            <h4 class="judul-halaman">Jadwal Mingguan</h4>

            <div class="week-nav">
                <button id="prevWeek" class="nav-btn">‹</button>

                <span id="rangeTanggal" class="week-range"></span>

                <button id="nextWeek" class="nav-btn">›</button>
            </div>
        </div>

    </div>


    {{-- CONTENT --}}
    <div class="jadwal-content">

        {{-- TIME --}}
        <div class="jadwal-time-column">

            <div class="time-spacer"></div>

            @for ($i = 7; $i <= 20; $i++) <div class="time-label">
                {{ sprintf('%02d:00', $i) }}
        </div>
        @endfor

    </div>


    {{-- CALENDAR --}}
    <div class="jadwal-calendar">

        {{-- HEADER DAY --}}
        <div class="jadwal-days" id="weekDays"></div>


        {{-- GRID --}}
        <div class="jadwal-grid">

            @for ($i = 7; $i <= 20; $i++) <div class="jadwal-row" data-hour="{{ sprintf('%02d:00', $i) }}">

                @for ($d = 0; $d < 7; $d++) <div class="jadwal-slot" data-day="{{ $d }}"
                    data-hour="{{ sprintf('%02d:00', $i) }}">

                    <div class="jadwal-events"></div>

        </div>

        @endfor

    </div>

    @endfor

</div>

</div>


{{-- SIDEBAR --}}
<div class="jadwal-sidebar">

    <button id="openClass" class="btn-primary-custom">
        + Tambah Kelas
    </button>

    <div class="filter-section">

        <h6>Filter Jenis Kelas</h6>

        <div class="filter-card">

            {{-- ALL --}}
            <label class="filter-item">

                <input type="checkbox" class="filter-checkbox" value="all" checked>

                <span class="checkmark"></span>

                <span class="label-text">
                    Semua Kelas
                </span>

                <span class="count" id="count-all">
                    0
                </span>

            </label>


            @foreach($classes as $class)

            <label class="filter-item">

                <input type="checkbox" class="filter-checkbox" value="{{ $class->title }}">

                <span class="checkmark"></span>

                <span class="label-text">
                    {{ $class->title }}
                </span>

                <span class="count" id="count-{{ \Illuminate\Support\Str::slug($class->title) }}">
                    0
                </span>

            </label>

            @endforeach

        </div>


        <h6 class="mt-3">Filter Coach</h6>

        <select id="filterCoach" class="form-select">

            <option value="all">
                Semua Coach
            </option>

            @foreach($coaches as $coach)

            <option value="{{ $coach->name }}">
                {{ $coach->name }}
            </option>

            @endforeach

        </select>

    </div>

</div>

</div>

</div>


{{-- =========================
   MODAL CREATE
========================= --}}
<div id="classModal" class="modal-overlay">

    <div class="modal-content">

        <h5>
            Tambah Kelas
        </h5>



        {{-- =========================
           TANGGAL
        ========================= --}}
        <label>
            Tanggal Kelas
        </label>

        <input type="date" id="scheduleDate" class="form-input">



        <form id="classForm">


            {{-- =========================
               KELAS
            ========================= --}}
            <label>
                Kelas
            </label>

            <select id="className" class="form-select">

                @foreach($classes as $class)

                <option value="{{ $class->id }}">

                    {{ $class->title }}

                </option>

                @endforeach

            </select>



            {{-- =========================
               JAM MULAI
            ========================= --}}
            <label>
                Jam Mulai
            </label>

            <input type="time" id="startTime" class="form-input">



            {{-- =========================
               DURASI
            ========================= --}}
            <label>
                Durasi
            </label>

            <select id="duration" class="form-select">

                <option value="30">

                    30 Menit

                </option>

                <option value="60" selected>

                    60 Menit

                </option>

                <option value="90">

                    90 Menit

                </option>

                <option value="120">

                    120 Menit

                </option>

            </select>



            {{-- =========================
               COACH
            ========================= --}}
            <label>
                Coach
            </label>

            <select id="coach" class="form-select">

                @foreach($coaches as $coach)

                <option value="{{ $coach->id }}">

                    {{ $coach->name }}

                </option>

                @endforeach

            </select>



            {{-- =========================
               STUDIO
            ========================= --}}
            <label>
                Studio
            </label>

            <select id="room" class="form-select">

                @foreach($rooms as $room)

                <option value="{{ $room->id }}" data-capacity="{{ $room->capacity }}">

                    {{ $room->name }}

                </option>

                @endforeach

            </select>



            {{-- =========================
               KAPASITAS AUTO
            ========================= --}}
            <label>
                Kapasitas
            </label>

            <input type="number" id="quota" class="form-input" readonly>



            {{-- =========================
               ACTION
            ========================= --}}
            <div class="modal-actions">

                <button type="button" id="closeModal" class="btn-outline-custom">

                    Cancel

                </button>

                <button type="submit" class="btn-primary-custom">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================
   MODAL DETAIL
========================= --}}
<div id="detailModal" class="modal-overlay">

    <div class="modal-content">

        {{-- =========================
           TITLE
        ========================= --}}
        <h5 id="detailTitle"></h5>



        {{-- =========================
           INFO LIST
        ========================= --}}
        <div class="detail-info-list">

            {{-- JAM --}}
            <div class="detail-info-item">

                <strong>
                    Jam
                </strong>

                <span id="detailTime"></span>

            </div>



            {{-- COACH --}}
            <div class="detail-info-item">

                <strong>
                    Coach
                </strong>

                <span id="detailCoach"></span>

            </div>



            {{-- KAPASITAS --}}
            <div class="detail-info-item">

                <strong>
                    Kapasitas
                </strong>

                <span id="detailQuota"></span>

            </div>

        </div>



        {{-- =========================
           STUDIO
        ========================= --}}
        <div class="mt-3">

            <label>

                <strong>
                    Studio
                </strong>

            </label>

            <select id="editRoom" class="form-select mt-2">

                @foreach($rooms as $room)

                <option value="{{ $room->id }}" data-capacity="{{ $room->capacity }}">

                    {{ $room->name }}

                </option>

                @endforeach

            </select>

        </div>



        {{-- =========================
           INFO KAPASITAS
        ========================= --}}
        <div class="mt-3">

            <label>

                <strong>
                    Kapasitas Studio
                </strong>

            </label>

            <input type="number" id="editQuota" class="form-input mt-2" readonly>

        </div>



        {{-- =========================
           ACTION
        ========================= --}}
        <div class="modal-actions mt-3">

            <button id="saveRoomBtn" class="btn-primary-custom">

                Update Studio

            </button>

        </div>

    </div>

</div>



@endsection