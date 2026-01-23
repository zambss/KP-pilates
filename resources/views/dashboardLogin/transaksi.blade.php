@extends('layouts.dashboard')

@section('content')

{{-- =========================
   DASHBOARD HEADER
========================= --}}
<div class="dashboard-header">
    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p>Member sejak {{ auth()->user()->created_at->translatedFormat('d M Y') }}</p>
</div>

{{-- =========================
   SUMMARY CARD
========================= --}}

{{-- SUMMARY --}}
<div class="dashboard-summary">
    <div class="summary-card">
        <p>Total Sesi Aktif</p>
        <h2>6</h2>
        <span>Dari 2 Paket</span>
    </div>

    <div class="summary-card">
        <p>Kelas Mendatang</p>
        <h2>2</h2>
        <span>Sudah Terjadwal</span>
    </div>

    <div class="summary-card">
        <p>Total Sesi Diikuti</p>
        <h2>7</h2>
        <span>Sesi bulan ini: 7</span>
    </div>
</div>

{{-- KELAS MENDATANG --}}
<div class="dashboard-section">
    <div class="section-header">
        <h3>Kelas Mendatang</h3>
        <p>Jadwal kelas yang sudah Anda booking</p>
    </div>

    <div class="upcoming-wrapper">
        <div class="calendar-icon">
            📅
        </div>

        <div class="class-card-horizontal">
            <div class="class-info">
                <h4>Mat Pilates</h4>
                <p>Coach Amanda Wong</p>

                <div class="class-meta">
                    <span>📅 12 Jan 2026</span>
                    <span>⏰ 10:30 - 11:30</span>
                </div>
            </div>

            <span class="class-status confirmed">
                ✓ Confirmed
            </span>
        </div>
    </div>
</div>

{{-- RIWAYAT TRANSAKSI --}}
<div class="dashboard-section">
    <div class="section-header">
        <h3>Riwayat Transaksi</h3>
        <p>Pembelian paket terbaru</p>
    </div>

    <div class="transaction-table">

        <div class="transaction-row head">
            <span>ID Transaksi</span>
            <span>Paket</span>
            <span>Tanggal</span>
            <span>Jumlah</span>
            <span>Status</span>
        </div>

        <div class="transaction-row">
            <span>TRX-001</span>
            <span>Reformer Pilates 8 Sesi</span>
            <span>5 Jan 2026</span>
            <span>Rp792.000</span>
            <span class="status paid">✓ Status</span>
        </div>

        <div class="transaction-row">
            <span>TRX-002</span>
            <span>Mat Pilates 5 Sesi</span>
            <span>20 Dec 2025</span>
            <span>Rp300.000</span>
            <span class="status paid">✓ Status</span>
        </div>

        <button class="btn-view-all">
            Lihat Semua Transaksi
        </button>
    </div>
</div>

@endsection