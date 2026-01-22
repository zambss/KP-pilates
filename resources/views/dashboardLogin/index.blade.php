@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

@auth
<div class="dashboard-header">
    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p>
        Member sejak
        {{ auth()->user()->created_at->translatedFormat('d M Y') }}
    </p>
</div>
@endauth


<!-- STAT -->
<div class="stats-grid">
    <div class="stat-card">
        <span>Total Sesi Aktif</span>
        <h2>6</h2>
        <small>Dari 2 Paket</small>
    </div>

    <div class="stat-card">
        <span>Kelas Mendatang</span>
        <h2>2</h2>
        <small>Sudah Terjadwal</small>
    </div>

    <div class="stat-card">
        <span>Total Sesi Diikuti</span>
        <h2>7</h2>
        <small>Sesi bulan ini</small>
    </div>
</div>

<!-- KELAS MENDATANG -->
<section class="section">
    <div class="section-header">
        <h3>Kelas Mendatang</h3>
        <a href="#">Lihat Semua</a>
    </div>

    <div class="class-card">
        <div>
            <strong>Reformer Pilates</strong>
            <p>Coach Jessica Lee</p>
            <small>10 Jan 2026 · 09:00 - 10:00</small>
        </div>
        <span class="badge confirmed">Confirmed</span>
    </div>

    <div class="class-card">
        <div>
            <strong>Mat Pilates</strong>
            <p>Coach Amanda Wong</p>
            <small>12 Jan 2026 · 10:30 - 11:30</small>
        </div>
        <span class="badge confirmed">Confirmed</span>
    </div>
</section>

<!-- RIWAYAT TRANSAKSI -->
<section class="section">
    <h3>Riwayat Transaksi</h3>

    <table class="transaction-table">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Paket</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>TRX-001</td>
                <td>Reformer Pilates 8 Sesi</td>
                <td>5 Jan 2026</td>
                <td>Rp792.000</td>
                <td><span class="badge paid">Paid</span></td>
            </tr>
            <tr>
                <td>TRX-002</td>
                <td>Mat Pilates 5 Sesi</td>
                <td>20 Dec 2025</td>
                <td>Rp300.000</td>
                <td><span class="badge paid">Paid</span></td>
            </tr>
        </tbody>
    </table>

    <a class="btn-full" href="#">Lihat Semua Transaksi</a>
</section>

@endsection