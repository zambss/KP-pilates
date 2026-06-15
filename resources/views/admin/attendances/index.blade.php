@extends('layouts.admin')

@section('title', 'Absensi')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold">📋 Absensi Kelas</h3>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-4 p-3 rounded bg-gray-100 text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 rounded bg-gray-100 text-sm">
        {{ session('error') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="table-card">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Class</th>
                    <th>Coach</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($bookings as $b)
                <tr>

                    <td class="fw-semibold">{{ $b->user->name }}</td>

                    <td>{{ $b->classSchedule->class->title }}</td>

                    <td>{{ $b->classSchedule->coach->name ?? '-' }}</td>

                    <td>{{ $b->classSchedule->date }}</td>

                    <td>
                        {{ $b->classSchedule->start_time }} -
                        {{ $b->classSchedule->end_time }}
                    </td>

                    <td>
                        <form action="{{ route('attendance.do', $b->id) }}" method="POST">
                            @csrf
                            <button class="btn-primary-custom btn-sm">
                                ✔ Absen
                            </button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Tidak ada booking untuk absensi
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection