@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">👤 Edit Profile</h4>

        <form method="POST" action="{{ route('profiles.update', $profile->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- PHONE -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $profile->phone }}" class="form-input">
            </div>

            <!-- ADDRESS -->
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-input" rows="3">{{ $profile->address }}</textarea>
            </div>

            <!-- AVATAR PREVIEW -->
            <div class="form-group">
                <label>Avatar</label>

                <div class="avatar-preview">
                    <img src="{{ asset('storage/'.$profile->avatar) }}">
                </div>

                <input type="file" name="avatar" class="form-input mt-2">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('profiles.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection