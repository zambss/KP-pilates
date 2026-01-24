@extends('layouts.app')

@section('content')
<div class="receipt-wrapper">

    <!-- HEADER -->
    <div class="receipt-header">
        <a href="{{ url()->previous() }}" class="back-link">←</a>
        <h2>Ringkasan Pembayaran</h2>

        <div class="booking-steps">
            <span class="step done">1</span>
            <span class="step-line"></span>
            <span class="step active">2</span>
        </div>
    </div>

    <!-- RINGKASAN KELAS -->
    <div class="receipt-card">
        <p class="summary-date">
            Sab, 24 Jan 2026 · 10.00 – 11.00
        </p>

        <div class="receipt-route">
            <span>Reformer Pilates</span>
            <span>→</span>
            <span>Studio Utama</span>
        </div>

        <p class="receipt-meta">
            Coach Jessica Lee · 1 Peserta
        </p>
    </div>

    <!-- RINCIAN HARGA -->
    <div class="receipt-price-box">

        <!-- TIMER -->
        <div class="receipt-timer">
            Selesaikan pembayaran dalam <strong>00 : 59 : 40</strong>
        </div>

        <div class="receipt-item">
            <span>Reformer Pilates (1 Sesi)</span>
            <strong>Rp250.000</strong>
        </div>

        <div class="receipt-item">
            <span>Biaya Layanan</span>
            <span>Rp0</span>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-total">
            <span>Total Tagihan</span>
            <strong>Rp250.000</strong>
        </div>
    </div>

    <!-- INFO -->
    <div class="receipt-info">
        Transaksi ini <strong>belum dibayar</strong>.
        Silakan lakukan pembayaran sebelum waktu berakhir agar
        pendaftaran kelas tidak dibatalkan otomatis.
    </div>

    <!-- ACTION -->
    <div class="receipt-action">
        <a href="#" class="btn-pay">
            BAYAR SEKARANG
        </a>

        <a href="{{ route('dashboardLogin.index') }}" class="btn-cart">
            Tambahkan ke Keranjang
        </a>
    </div>

</div>
@endsection