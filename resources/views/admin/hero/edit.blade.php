@extends('layouts.admin')

@section('title', 'Edit Hero')

@section('content')

<div class="max-w-xl mx-auto">
<div class="package-card">

<h4 class="package-title">✏️ Edit Hero</h4>

<form method="POST" action="{{ route('admin.hero.update',$hero->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<input type="text" name="subtitle" value="{{ $hero->subtitle }}" class="form-input">
<input type="text" name="title" value="{{ $hero->title }}" class="form-input">
<textarea name="description" class="form-input">{{ $hero->description }}</textarea>

<input type="number" name="members" value="{{ $hero->members }}" class="form-input">
<input type="number" name="weekly_classes" value="{{ $hero->weekly_classes }}" class="form-input">

<input type="file" name="image" class="form-input">
<img src="{{ asset('storage/'.$hero->image) }}" width="120">

<div class="form-actions">
<button class="btn-primary-custom">Update</button>
<a href="{{ route('admin.hero.index') }}" class="btn-outline-custom">Kembali</a>
</div>

</form>
</div>
</div>
@endsection