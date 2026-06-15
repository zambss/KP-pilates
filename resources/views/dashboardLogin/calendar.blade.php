@extends('layouts.dashboard')

@section('content')

<h2 class="page-title">
    Pilih Kelas
</h2>


<div class="class-grid">

    @forelse($classes as $class)

    <div class="class-card simple">

        <div class="class-top">

            <h4>
                {{ $class->title }}
            </h4>

            @php
            $totalSchedule = $class->schedules
            ->where('date', '>=', now()->toDateString())
            ->count();
            @endphp

            <small class="class-total-schedule">
                {{ $totalSchedule }} Jadwal Tersedia
            </small>

        </div>


        {{-- LIST JADWAL --}}
        <div class="class-schedule-list">

            @forelse(
            $class->schedules
            ->where('date', '>=', now()->toDateString())
            ->sortBy('date')
            ->take(3)

            as $schedule
            )

            <div class="schedule-item">

                <div class="schedule-item-info">

                    <strong>
                        {{ \Carbon\Carbon::parse($schedule->date)
                            ->translatedFormat('D, d M Y') }}
                    </strong>

                    <p>
                        {{ substr($schedule->start_time,0,5) }}
                        -
                        {{ substr($schedule->end_time,0,5) }}
                    </p>

                    <small>
                        Coach:
                        {{ $schedule->coach->name ?? '-' }}
                    </small>

                </div>


                <div class="schedule-item-status">

                    @if(!$schedule->is_open)

                    <span class="badge-closed">
                        CLOSED
                    </span>

                    @elseif($schedule->remaining_quota <= 0) <span class="badge-full">
                        FULL
                        </span>

                        @else

                        <span class="badge-open">
                            OPEN
                        </span>

                        @endif

                </div>

            </div>

            @empty

            <p class="empty-mini">
                Belum ada jadwal
            </p>

            @endforelse

        </div>


        <a href="{{ route('dashboard.classes.detail', $class->id) }}" class="btn-hint">
            Lihat Detail Jadwal
        </a>

    </div>

    @empty

    <p class="empty-text">
        Belum ada kelas tersedia
    </p>

    @endforelse

</div>

@endsection