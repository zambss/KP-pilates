@extends('layouts.app')

@section('content')
<div class="booking-page">

    <div class="booking-wrapper">

        <!-- HEADER -->
        <div class="booking-header">
            <a href="{{ url()->previous() }}" class="back-link">←</a>

            <div class="booking-title">
                <h2>Pendaftaran Kelas</h2>

                <div class="booking-steps">
                    <span class="step active">1</span>
                    <span class="step-line"></span>
                    <span class="step">2</span>
                </div>
            </div>
        </div>

        <!-- BOX UTAMA -->
        <div class="booking-box">

            <!-- RINGKASAN KELAS -->
            <div class="summary-card">
                <p class="summary-date">
                    Sab, 24 Jan 2026 · 10.00 – 11.00
                </p>

                <div class="summary-route">
                    <strong>Reformer Pilates</strong>
                    <span class="route-arrow">→</span>
                    <strong>Studio Utama</strong>
                </div>
            </div>

            <!-- FORM DATA -->
            <form id="registrationForm" method="POST" action="#">
                @csrf

                <!-- DETAIL PESERTA -->
                <div class="form-section">
                    <h3>Detail Peserta</h3>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat">
                    </div>

                    <div class="form-group">
                        <label>Catatan Kesehatan</label>
                        <input type="text" name="catatan_kesehatan">
                    </div>

                    <div class="form-group">
                        <label>Kontak Darurat</label>
                        <input type="text" name="kontak_darurat">
                    </div>

                    <div class="form-group">
                        <label>Nama dan Status (Anton sebagai Suami)</label>
                        <input type="text" name="hubungan">
                    </div>
                </div>

                <!-- PERNYATAAN -->
                <div class="form-section agreement-section">
                    <h3>Pernyataan Persetujuan</h3>

                    <div class="agreement-box">
                        <p>
                            Menyatakan secara sadar dan sungguh-sungguh menyetujui hal-hal berikut
                            terkait partisipasi saya dalam kelas pilates yang diselenggarakan oleh
                            RENS Pilates & Wellness:
                        </p>

                        <ul>
                            <li>Saya berada dalam kondisi fisik yang sehat dan tidak memiliki kondisi medis berbahaya.
                            </li>
                            <li>Aktivitas fisik memiliki risiko cedera tertentu.</li>
                            <li>Saya akan memberi tahu instruktur jika merasa tidak nyaman.</li>
                            <li>Saya mengikuti kelas secara sukarela dan menanggung risikonya.</li>
                            <li>Saya melepaskan tuntutan hukum kecuali kelalaian berat.</li>
                            <li>Saya mematuhi aturan, kebijakan, dan instruksi instruktur.</li>
                            <li>Pembatalan atau perubahan jadwal kurang dari 12 jam tidak diperbolehkan.</li>
                        </ul>

                        <p>
                            Demikian pernyataan ini saya buat dengan sebenar-benarnya, tanpa paksaan
                            dari pihak manapun.
                        </p>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="booking-action">
                    <button type="submit" class="btn-primary">
                        LANJUTKAN
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection