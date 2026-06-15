@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit Fasilitas</h4>

        <form method="POST" action="{{ route('admin.facility.update',$facility->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $facility->name }}" class="form-input">
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="image" class="form-input">

                <img src="{{ asset('storage/'.$facility->image) }}" width="120" class="mt-2">
            </div>

            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('admin.facility.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection