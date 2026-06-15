@extends('layouts.admin')

@section('title', 'Tambah About')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah About</h4>

        <form method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="subtitle" class="form-input">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-input"></textarea>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="image" class="form-input">
            </div>

            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('admin.about.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection