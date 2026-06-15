@extends('layouts.admin')

@section('title', 'Tambah Profile')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">👤 Tambah Profile</h4>

        <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- USER -->
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-input">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- PHONE -->
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="phone" class="form-input" placeholder="No HP">
            </div>

            <!-- ADDRESS -->
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="address" class="form-input" rows="2" placeholder="Alamat"></textarea>
            </div>

            <!-- HEALTH -->
            <div class="form-group">
                <label>Catatan Kesehatan</label>
                <textarea name="health_note" class="form-input" rows="2" placeholder="Catatan kesehatan"></textarea>
            </div>

            <!-- EMERGENCY -->
            <div class="form-group">
                <label>Kontak Darurat</label>
                <input type="text" name="emergency_contact" class="form-input" placeholder="Kontak darurat">
            </div>

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-input">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- AVATAR -->
            <div class="form-group">
                <label>Avatar</label>
                <input type="file" name="avatar" class="form-input">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('user-profiles.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection