@extends('layouts.admin')

@section('title', 'Tambah Hero')

@section('content')

<div class="max-w-xl mx-auto">
<div class="package-card">

<h4 class="package-title">➕ Tambah Hero</h4>

<form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="subtitle" placeholder="Subtitle" class="form-input">
<input type="text" name="title" placeholder="Title" class="form-input">
<textarea name="description" class="form-input"></textarea>

<input type="number" name="members" class="form-input">
<input type="number" name="weekly_classes" class="form-input">

<input type="file" name="image" class="form-input">

<div class="form-actions">
<button class="btn-primary-custom">Simpan</button>
<a href="{{ route('admin.hero.index') }}" class="btn-outline-custom">Kembali</a>
</div>

</form>
</div>
</div>
@endsection