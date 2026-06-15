@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Booking</h4>

        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-input">
                    <option value="booked" {{ $booking->status == 'booked' ? 'selected' : '' }}>Booked</option>
                    <option value="attended" {{ $booking->status == 'attended' ? 'selected' : '' }}>Attended</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('bookings.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection