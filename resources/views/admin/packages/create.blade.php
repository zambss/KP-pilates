@extends('layouts.admin')

@section('title', 'Tambah Paket')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Paket</h4>

        <form method="POST" action="{{ route('packages.store') }}">
            @csrf

            <!-- NAMA -->
            <input type="text" name="name" class="form-input" placeholder="Nama Paket">

            <!-- HARGA -->
            <input type="number" name="price" class="form-input" placeholder="Harga">

            <!-- STATUS -->
            <div class="form-check-custom">
                <input type="checkbox" name="is_active" checked>
                <label>Aktif</label>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">
                <button class="btn-primary-custom">Simpan</button>
            </div>

        </form>

    </div>

</div>

@endsection