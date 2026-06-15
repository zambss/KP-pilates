@extends('layouts.admin')

@section('title', 'Bookings')

@section('content')

<div class="bookings-wrapper">

    <!-- HEADER -->
    <div class="bookings-header">
        <h4>📅 Booking Management</h4>

        <a href="{{ route('bookings.create') }}" class="btn-add">
            + Tambah Booking
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- FILTER -->
    <div class="filter-card">

        <form method="GET" class="filter-grid">

            <div class="filter-item">
                <label>Class</label>
                <select name="class_id">
                    <option value="">Semua Class</option>
                    @foreach($classes as $c)
                    <option value="{{ $c->id }}" {{ request('class_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-item">
                <label>Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}">
            </div>

            <div class="filter-item">
                <label>Jam</label>
                <input type="time" name="time" value="{{ request('time') }}">
            </div>

            <div class="filter-action">
                <button class="btn-primary-custom">Filter</button>
                <a href="{{ route('bookings.index') }}" class="btn-outline-custom">
                    Reset
                </a>
            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bookings-card">

        <table class="bookings-table">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Class</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($bookings as $b)

                <tr>

                    <td>{{ $b->user->name }}</td>

                    <td>
                        <span class="badge-soft">
                            {{ $b->schedule->class->title }}
                        </span>
                    </td>

                    <td>
                        <small>
                            {{ $b->schedule->date }} <br>
                            {{ $b->schedule->start_time }} - {{ $b->schedule->end_time }}
                        </small>
                    </td>

                    <td>
                        <span class="status-badge 
                        {{ $b->status == 'booked' ? 'booked' :
                           ($b->status == 'attended' ? 'attended' : 'cancel') }}">
                            {{ strtoupper($b->status) }}
                        </span>
                    </td>

                    <td class="action-cell">

                        <a href="{{ route('bookings.edit', $b->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('bookings.delete', $b->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete" onclick="return confirm('Yakin hapus booking?')">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada booking
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection