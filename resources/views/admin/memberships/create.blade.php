@extends('layouts.admin')

@section('title', 'Tambah Membership')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Membership</h4>

        <form method="POST" action="{{ route('memberships.store') }}">
            @csrf

            <!-- USER -->
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-input">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- CLASS -->
            <div class="form-group">
                <label>Class</label>
                <select name="class_id" class="form-input">
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- START -->
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-input">
            </div>

            <!-- END -->
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-input">
            </div>

            <!-- TOTAL -->
            <div class="form-group">
                <label>Total Sessions</label>
                <input type="number" name="total_sessions" class="form-input">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('memberships.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>
        </form>

    </div>

</div>

@endsection