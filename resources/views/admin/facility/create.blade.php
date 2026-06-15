@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Fasilitas</h4>

        <form method="POST" action="{{ route('admin.facility.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="image" class="form-input" required>
            </div>

            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('admin.facility.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection