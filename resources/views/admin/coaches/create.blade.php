@extends('layouts.admin')

@section('title', 'Tambah Coach')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">🏋️ Tambah Coach</h4>

        <form method="POST" action="{{ route('coaches.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- NAME -->
            <div class="form-group">
                <label>Nama Coach</label>
                <input type="text" name="name" class="form-input" placeholder="Nama Coach">
            </div>

            <!-- PHOTO -->
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="photo" class="form-input">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('coaches.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection