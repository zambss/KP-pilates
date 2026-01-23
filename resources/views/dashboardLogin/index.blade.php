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


<!-- ================= STAT ================= -->
<div class="stats-grid">
    <div class="stat-card stat-success">
        <span>Total Sesi Aktif</span>
        <h2>6</h2>
        <small>Dari 2 Paket</small>
    </div>

    <div class="stat-card stat-warning">
        <span>Kelas Mendatang</span>
        <h2>2</h2>
        <small>Sudah Terjadwal</small>
    </div>

    <div class="stat-card stat-neutral">
        <span>Total Sesi Diikuti</span>
        <h2>7</h2>
        <small>Sesi bulan ini</small>
    </div>
</div>


<!-- ================= KELAS MENDATANG ================= -->

<section class="section">
    <div class="section-header">
        <h3>Kelas Mendatang</h3>
        <a href="#">Lihat Semua</a>
    </div>

    @foreach ($classes as $class)
    <div class="class-card">
        <div>
            <strong>{{ $class->title }}</strong>
            <p>Coach {{ $class->coach }}</p>
            <small>{{ $class->date }} · {{ $class->time }}</small>
        </div>

        <div class="badges">
            <span class="badge {{ $class->status }}">
                {{ ucfirst($class->status) }}
            </span>
        </div>
    </div>
    @endforeach
</section>


<!-- ================= RIWAYAT TRANSAKSI ================= -->
<section class="section">
    <div class="section-header">
        <h3>Riwayat Transaksi</h3>
    </div>
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