@extends('layouts.admin')

@section('title', 'Edit Paket')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Paket</h4>

        <form method="POST" action="{{ route('packages.update', $package->id) }}">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <input type="text" name="name" value="{{ $package->name }}" class="form-input" placeholder="Nama Paket">

            <!-- HARGA -->
            <input type="number" name="price" value="{{ $package->price }}" class="form-input" placeholder="Harga">

            <!-- STATUS -->
            <div class="form-check-custom">
                <input type="checkbox" name="is_active" {{ $package->is_active ? 'checked' : '' }}>
                <label>Aktif</label>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('packages.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection