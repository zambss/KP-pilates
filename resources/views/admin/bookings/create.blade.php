@extends('layouts.admin')

@section('title', 'Tambah Booking')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow p-6">

        <h4 class="text-lg font-semibold mb-6">➕ Tambah Booking</h4>

        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf

            <!-- USER -->
            <div class="mb-4">
                <label class="block mb-1">User</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- MEMBERSHIP -->
            <div class="mb-4">
                <label class="block mb-1">Membership</label>
                <select name="membership_id" class="form-control">
                    @foreach($memberships as $m)
                    <option value="{{ $m->id }}">
                        {{ $m->user->name }} - {{ $m->class->title }}
                        ({{ $m->used_sessions }}/{{ $m->total_sessions }})
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- SCHEDULE -->
            <div class="mb-6">
                <label class="block mb-1">Jadwal Kelas</label>
                <select name="class_schedule_id" class="form-control">
                    @foreach($schedules as $s)
                    <option value="{{ $s->id }}">
                        {{ $s->class->title }} |
                        {{ $s->date }} |
                        {{ $s->start_time }} - {{ $s->end_time }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button class="btn-primary-custom px-4">Booking</button>
                <a href="{{ route('bookings.index') }}" class="btn-outline-custom px-4">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection