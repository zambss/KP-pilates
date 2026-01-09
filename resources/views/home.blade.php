@extends('layouts.main')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush


<section class="hero">
    <div class="hero-glass">
        <div class="hero-left">
            <span class="hero-subtitle">Premium Pilates Studio</span>

            <h1>Transform Your<br>Body & Mind</h1>

            <p>
                Bergabunglah dengan Rens Pilates dan rasakan perubahan nyata
                dalam kesehatan dan kebugaran Anda.
            </p>

            <div class="hero-buttons">
                <a href="#" class="btn-primary">Join Class Now</a>
                <a href="#" class="btn-outline">Become a Member</a>
            </div>

            <div class="hero-stats">
                <div>
                    <strong>500+</strong>
                    <span>Active Members</span>
                </div>
                <div>
                    <strong>50+</strong>
                    <span>Weekly Classes</span>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="class-card">
                <img src="{{ asset('images/hero-card.jpg') }}" alt="Pilates Class">
                <div class="card-info">
                    <h4>Reformer Pilates</h4>
                    <p>Today, 10:00 AM</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ABOUT PREVIEW --}}
<section class="about-preview">
    <div class="container">
        <h2>About Me</h2>
        <p>
            Rens Pilates adalah studio pilates yang berfokus pada kesehatan tubuh
            dan ketenangan pikiran.
        </p>
        <a href="/about" class="btn-secondary">Read More</a>
    </div>
</section>

{{-- FASILITAS --}}
<section class="fasilitas-preview">
    <div class="container">
        <h2>Fasilitas</h2>

        <div class="fasilitas-list">
            <div class="card">Studio Nyaman</div>
            <div class="card">Alat Pilates Lengkap</div>
            <div class="card">Ruang Ganti</div>
        </div>

        <a href="/fasilitas">Lihat Semua</a>
    </div>
</section>

{{-- COACH --}}
<section class="coach-preview">
    <div class="container">
        <h2>Coach</h2>

        <div class="coach-list">
            <div class="coach-card">
                <img src="/images/coach1.png" alt="Coach">
                <h3>Coach Rens</h3>
            </div>
        </div>
    </div>
</section>

{{-- EVENT & PROMO --}}
<section class="event-preview">
    <div class="container">
        <h2>Event & Promo</h2>
        <p>Ikuti event dan promo menarik dari Rens Pilates</p>
        <a href="/event">Lihat Event</a>
    </div>
</section>

{{-- FAQ --}}
<section class="faq-preview">
    <div class="container">
        <h2>FAQ</h2>
        <p>Pertanyaan yang sering diajukan</p>
        <a href="/faq">Baca FAQ</a>
    </div>
</section>

{{-- CTA JOIN --}}
<section class="cta">
    <div class="container">
        <h2>Siap Mulai Pilates?</h2>
        <a href="/join-class" class="btn-primary">Join Class Sekarang</a>
    </div>
</section>

@endsection