@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

{{-- HEADER --}}
<div class="dashboard-header">
    <h1>Notifikasi</h1>
    <p>4 notifikasi belum dibaca</p>
</div>

<section class="section notification-section">

    {{-- SECTION HEADER --}}
    <div class="notification-header">
        <div>
            <h3>Semua Notifikasi</h3>
            <p>Kelola notifikasi dan reminder Anda</p>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="notification-filter">
        <button type="button" class="filter-btn active" data-filter="all">
            Semua <span>4</span>
        </button>

        <button type="button" class="filter-btn" data-filter="unread">
            Belum Dibaca <span>2</span>
        </button>
    </div>

    {{-- LIST NOTIFIKASI --}}
    <div class="notification-list">

        {{-- ITEM 1 --}}
        <div class="notification-item unread">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>Reminder Kelas Besok</h4>
                <p>
                    Anda memiliki kelas Reformer Pilates dengan Coach Jessica Lee
                    besok pukul 09:00
                </p>

                <div class="notif-action">
                    <a href="#" class="mark-read">Tandai Dibaca</a>
                    <a href="#" class="danger">Sampah</a>
                </div>
            </div>

            <div class="notif-date">18 Jan 2026</div>
        </div>

        {{-- ITEM 2 --}}
        <div class="notification-item unread">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>Card Anda Akan Segera Berakhir</h4>
                <p>
                    Card Mat Pilates & Yoga Anda akan berakhir dalam 21 hari
                    (28 Feb 2026). Perpanjang sekarang!
                </p>

                <div class="notif-action">
                    <a href="#" class="danger">Sampah</a>
                </div>
            </div>

            <div class="notif-date">18 Jan 2026</div>
        </div>

        {{-- ITEM 3 --}}
        <div class="notification-item">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>Promo Spesial Member!</h4>
                <p>
                    Dapatkan diskon 20% untuk pembelian paket Reformer Pilates 12 sesi.
                    Promo berlaku hingga akhir bulan!
                </p>

                <div class="notif-action">
                    <a href="#" class="mark-read">Tandai Dibaca</a>
                    <a href="#" class="danger">Sampah</a>
                </div>
            </div>

            <div class="notif-date">18 Jan 2026</div>
        </div>

        {{-- ITEM 4 --}}
        <div class="notification-item">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>Kelas Hari Ini</h4>
                <p>
                    Jangan lupa! Anda memiliki kelas Yoga Flow dengan Coach Linda Chen
                    hari ini pukul 18:00
                </p>

                <div class="notif-action">
                    <a href="#" class="danger">Sampah</a>
                </div>
            </div>

            <div class="notif-date">18 Jan 2026</div>
        </div>

    </div>
</section>

@endsection