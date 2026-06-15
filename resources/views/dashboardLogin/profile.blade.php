@extends('layouts.dashboard')

@push('styles')
    <link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

    <div class="dashboard-header">
        <h1>Profile</h1>
        <p>Kelola informasi akun dan preferensi Anda</p>
    </div>

    <section class="section profile-wrapper">
        <div class="profile-card">

            {{-- =========================
            HEADER PROFILE
            ========================= --}}
            <div class="profile-header">


                {{-- =========================
                AVATAR + UPLOAD
                ========================= --}}
                <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data"
                    class="avatar-upload-form">

                    @csrf

                    <label class="profile-avatar upload-avatar">

                        @if (!empty($profile->avatar))

                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar {{ $user->name }}"
                                class="avatar-img">

                        @else

                            <span class="avatar-initial">

                                {{ strtoupper(substr($user->name, 0, 2)) }}

                            </span>

                        @endif



                        {{-- OVERLAY --}}
                        <div class="avatar-overlay">

                            Ganti Foto

                        </div>



                        {{-- INPUT FILE --}}
                        <input type="file" name="avatar" accept="image/*" onchange="this.form.submit()" hidden>

                    </label>

                </form>



                {{-- =========================
                INFO USER
                ========================= --}}
                <div class="profile-info">

                    <h3>

                        {{ $user->name }}

                    </h3>

                    <p>

                        Member ID · {{ $user->id }}

                    </p>

                </div>

            </div>

            <!-- FORM PROFILE -->
            <form class="profile-form">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ $user->email }}" readonly>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" value="{{ $profile->phone ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" value="{{ $profile->address ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Catatan kesehatan</label>
                    <input type="text" value="{{ $profile->health_note ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Kontak darurat</label>
                    <input type="text" value="{{ $profile->emergency_contact ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="{{ ucfirst($profile->status) }}" readonly>
                </div>

            </form>

        </div>

    </section>

@endsection