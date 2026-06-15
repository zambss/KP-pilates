@extends('layouts.admin')

@section('title', 'Edit About')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit About</h4>

        <form method="POST" action="{{ route('admin.about.update',$about->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{ $about->title }}" class="form-input">
            </div>

            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="subtitle" value="{{ $about->subtitle }}" class="form-input">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-input">{{ $about->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="image" class="form-input">

                <img src="{{ asset('storage/'.$about->image) }}" width="120" class="mt-2">
            </div>

            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('admin.about.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection