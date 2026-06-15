@extends('layouts.admin')

@section('title', 'Tambah Class')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Class</h4>

        <form method="POST" action="{{ route('classes.storee') }}">
            @csrf

            <!-- NAMA -->
            <div class="form-group">
                <label>Nama Class</label>
                <input type="text" name="title" class="form-input" required>
            </div>

             <div class="form-group">
               <label>Category</label>
                <input type="text" name="category" class="form-input" required>
            </div>
            

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-input" rows="3"></textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('classes.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection