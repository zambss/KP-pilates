@extends('layouts.admin')

@section('title', 'Edit Class')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Class</h4>

        <form method="POST" action="{{ route('classes.update', $class->id) }}">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="form-group">
                <label>Nama Class</label>
                <input type="text" name="title" value="{{ $class->title }}" class="form-input">
            </div>

            <!-- CATEGORY -->
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ $class->category }}" class="form-input">
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-input" rows="3">{{ $class->description }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('classes.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection