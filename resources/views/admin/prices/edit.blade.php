@extends('layouts.admin')

@section('title', 'Edit Harga')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">💰 Edit Harga</h4>

        <form method="POST" action="{{ route('prices.update', $price->id) }}">
            @csrf
            @method('PUT')

            <!-- SESSION -->
            <input type="number" name="session_count" value="{{ $price->session_count }}" class="form-input"
                placeholder="Jumlah Sesi">

            <!-- BONUS -->
            <input type="number" name="bonus_sessions" value="{{ $price->bonus_sessions }}" class="form-input"
                placeholder="Bonus Sesi">

            <!-- PRICE -->
            <input type="number" name="price" value="{{ $price->price }}" class="form-input" placeholder="Harga">

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('prices.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection