@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Order</h4>

        <form method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <!-- PRICE -->
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price" value="{{ $order->price }}" class="form-input">
            </div>

            <!-- SESSION -->
            <div class="form-group">
                <label>Jumlah Sesi</label>
                <input type="number" name="total_sessions" value="{{ $order->total_sessions }}" class="form-input">
            </div>

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-input">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('orders.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection