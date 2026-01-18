@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<h1 class="welcome">Selamat Datang, Katrina!</h1>
<p class="member-since">Member sejak 15 Jan 2026</p>

<div id="openLoginModal" class=" stats-grid">
    <div class="stat-card">
        <span>Total Sesi Aktif</span>
        <strong>6</strong>
        <small>Dari 2 Paket</small>
    </div>

    <div class="stat-card">
        <span>Kelas Mendatang</span>
        <strong>2</strong>
        <small>Sudah Terjadwal</small>
    </div>

    <div class="stat-card">
        <span>Total Sesi Diikuti</span>
        <strong>7</strong>
        <small>Sesi bulan ini</small>
    </div>
</div>

<h2 class="section-title">Card Aktif</h2>

<div class="card-grid">
    <div class="card-box">
        <div class="card-header">
            <strong>Card Aktif</strong>
            <span class="badge">Active</span>
        </div>

        <p>Sesi tersisa</p>
        <div class="progress">
            <div class="progress-fill" style="width:62%"></div>
        </div>

        <div class="card-footer">
            <span>3 sesi digunakan</span>
            <span>5 sesi tersisa</span>
        </div>
    </div>

    <div class="card-box">
        <div class="card-header">
            <strong>Mat Pilates & Yoga</strong>
            <span>21 hari</span>
        </div>

        <p>Valid hingga 28 Feb 2026</p>

        <div class="progress">
            <div class="progress-fill" style="width:20%"></div>
        </div>

        <div class="card-footer">
            <span>4 sesi digunakan</span>
            <span>1 sesi tersisa</span>
        </div>
    </div>
</div>

@endsection