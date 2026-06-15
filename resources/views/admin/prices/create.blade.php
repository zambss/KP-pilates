@extends('layouts.admin')

@section('title', 'Tambah Harga')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Harga</h4>

        <form method="POST" action="{{ route('prices.store') }}">
            @csrf

            <!-- CLASS -->
            <select name="class_id" class="form-input">
                @foreach($classes as $c)
                <option value="{{ $c->id }}">{{ $c->title }}</option>
                @endforeach
            </select>

            <!-- SESSION -->
            <input type="number" name="session_count" class="form-input" placeholder="Jumlah sesi">

            <!-- BONUS -->
            <input type="number" name="bonus_sessions" class="form-input" placeholder="Bonus sesi">

            <!-- PRICE -->
            <input type="number" name="price" class="form-input" placeholder="Harga">

            <!-- BUTTON -->
            <div class="form-actions">
                <button class="btn-primary-custom">Simpan</button>
            </div>

        </form>

    </div>

</div>

@endsection