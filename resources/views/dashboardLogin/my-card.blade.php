@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<div class="dashboard-header">
    <h1>Card Saya</h1>
</div>

<!-- CARD SAYA -->
<div class="card-summary-grid">
    <div class="summary-card">
        <div class="summary-header">
            <strong>Reformer Pilates</strong>
            <span class="status active">Active</span>
        </div>

        <div class="summary-info">
            <p>Valid dari 15 Jan 2026</p>
            <p>Valid hingga 15 April 2026</p>
        </div>

        <div class="summary-footer">
            <span>Total kelas</span>
            <strong>8</strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-header">
            <strong>Reformer Pilates</strong>
            <span class="status active">Active</span>
        </div>

        <div class="summary-info">
            <p>Valid dari 15 Jan 2026</p>
            <p>Valid hingga 15 April 2026</p>
        </div>

        <div class="summary-footer">
            <span>Total kelas</span>
            <strong>8</strong>
        </div>
    </div>
</div>

<!-- CARD AKTIF -->
<h2 class="section-title">Card Aktif</h2>

<div class="card-active-grid">
    <div class="active-card">
        <div class="active-header">
            <div>
                <strong>Card Aktif</strong>
                <p>Total Sesi Aktif</p>
            </div>
            <span class="status active">Active</span>
        </div>

        <div class="active-info">
            <div class="session-row">
                <span>Sesi tersisa</span>
                <strong>5 / 8</strong>
            </div>

            <div class="progress">
                <div class="progress-fill" style="width:62%"></div>
            </div>

            <div class="session-footer">
                <span>3 sesi digunakan</span>
                <span>5 sesi tersisa</span>
            </div>
        </div>

        <a href="#" class="btn-primary">Booking Kelas</a>
    </div>

    <div class="active-card">
        <div class="active-header">
            <div>
                <strong>Mat Pilates & Yoga</strong>
                <p>Valid hingga 28 Feb 2026</p>
            </div>
            <span class="countdown">⏱ 21 hari</span>
        </div>

        <div class="active-info">
            <div class="session-row">
                <span>Sesi tersisa</span>
                <strong>1 / 5</strong>
            </div>

            <div class="progress">
                <div class="progress-fill" style="width:20%"></div>
            </div>

            <div class="session-footer">
                <span>4 sesi digunakan</span>
                <span>1 sesi tersisa</span>
            </div>
        </div>

        <a href="#" class="btn-primary">Booking Kelas</a>
    </div>
</div>

@endsection