@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header">
        <h2>REGISTER AKUN ANDA!!</h2>
        <p>Kelola akun anda untuk mendapatkan pengalaman pilates bersama kami</p>
    </div>

    <form id="registrationForm" method="POST" action="#">
        @csrf

        <div class="form-card">

            <!-- JUDUL FORM -->
            <h3>Buat akun untuk menjadi member Rens Pilates</h3>

            <!-- FIELD FORM -->
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="nama_lengkap" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="alamat">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nomor_telepon">
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="catatan_kesehatan">
            </div>

            <div class="form-group">
                <label>Catatan Kesehatan (opsional)</label>
                <input type="text" name="kontak_darurat">
            </div>

            <div class="form-group">
                <label>Kontak Darurat</label>
                <input type="text" name="hubungan">
            </div>

            <div class="form-group">
                <label>Nama dan Status (Anton Sebagai Suami)</label>
                <input type="text" name="hubungan">
            </div>
        </div>

</div>

<!-- ACTION BUTTON -->
<div class="form-actions">
    <a href="{{ url()->previous() }}" class="btn-back">
        ← Kembali ke Beranda
    </a>

    <button type="submit" class="btn-next">
        Daftar
    </button>
</div>

</form>
</div>
@endsection