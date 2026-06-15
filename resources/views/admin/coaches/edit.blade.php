@extends('layouts.admin')

@section('title', 'Edit Coach')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Coach</h4>

        <form method="POST" action="{{ route('coaches.update', $coach->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="form-group">
                <label>Nama Coach</label>
                <input type="text" name="name" value="{{ $coach->name }}" class="form-input">
            </div>

            <!-- PHOTO PREVIEW -->
            <div class="form-group">
                <label>Foto</label>

                <div class="avatar-preview">
                    <img src="{{ asset('storage/' . $coach->photo) }}">
                </div>

                <input type="file" name="photo" class="form-input mt-2">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('coaches.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection