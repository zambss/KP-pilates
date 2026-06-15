@extends('layouts.admin')

@section('title', 'Edit Membership')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Membership</h4>

        <form method="POST" action="{{ route('memberships.update', $membership->id) }}">
            @csrf
            @method('PUT')

            <!-- USER -->
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-input">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $membership->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- CLASS -->
            <div class="form-group">
                <label>Class</label>
                <select name="class_id" class="form-input">
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $membership->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- DATE -->
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $membership->start_date }}" class="form-input">
            </div>

            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $membership->end_date }}" class="form-input">
            </div>

            <!-- SESSION -->
            <div class="form-group">
                <label>Total Sessions</label>
                <input type="number" name="total_sessions" value="{{ $membership->total_sessions }}" class="form-input">
            </div>

            <div class="form-group">
                <label>Used Sessions</label>
                <input type="number" name="used_sessions" value="{{ $membership->used_sessions }}" class="form-input">
            </div>

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-input">
                    <option value="active" {{ $membership->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ $membership->status == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('memberships.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection