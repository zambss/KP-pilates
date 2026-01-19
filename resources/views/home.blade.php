@extends('layouts.main')
@section('content')
@include('components.login-modal')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<script src="{{ asset('js/modal.js') }}"></script>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

<section class="hero">
    <div class="hero-glass">
        <div class="hero-left">
            <span class="hero-subtitle">Premium Pilates Studio</span>

            <h1>Transform Your<br>Body & Mind</h1>

            <p>
                Bergabunglah dengan Rens.Pilates dan rasakan perubahan nyata
                dalam kesehatan dan kebugaran Anda. Kelas premium dengan
                instruktur bersertifikat, fasilitas modern, dan komunitas yang mendukung.
            </p>

            <div class="hero-buttons">
                <a href="#" class="btn-primary" id="openLogin">Join Class Now</a>
            </div>

            <div class="hero-divider"></div>

            <div class="hero-stats">
                <div class="stat-box">
                    <strong>500+</strong>
                    <span>Active Members</span>
                </div>
                <div class="stat-box">
                    <strong>50+</strong>
                    <span>Weekly Classes</span>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="class-card">
                <img src="image/Screenshot 2026-01-08 204300 1.png" alt="Reformer Pilates" class="card-img">

                <div class="card-info">
                    <div class="info-text">
                        <span class="category">Weekly Classes</span>
                        <h4>Reformer Pilates</h4>
                        <p>Today, 10:00 AM</p>
                    </div>
                    <div class="arrow-circle">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- EVENT & PROMO --}}
<section id="event" class="event-preview">
    <div class="container">
        <h2>Event & Promo</h2>
        <h2>jangan lewatkan event dan promo menarik</h2>
        <p>Ikuti event spesial dan manfaatkan promo eksklusif kami</p>
        <p>pilih paket membership</p>
    </div>
    <div class="event-grid">
        <!-- BASIC -->
        <div class="event-card">
            <span class="badge">STARTER</span>
            <h3 class="title">BASIC</h3>
            <p class="price">Rp 599K <span>/bulan</span></p>

            <ul class="benefit">
                <li>4 Kelas/bulan</li>
                <li>Akses Mat Pilates</li>
                <li>Loker Gratis</li>
            </ul>
        </div>

        <!-- PREMIUM -->
        <div class="event-card highlight">
            <span class="badge">STARTER</span>
            <h3 class="title">PREMIUM</h3>
            <p class="price">Rp 999K <span>/bulan</span></p>

            <ul class="benefit">
                <li>8 Kelas/bulan</li>
                <li>Mat + Reformer Pilates</li>
                <li>1 Private Session</li>
                <li>Towel Service</li>
            </ul>
        </div>

        <!-- UNLIMITED -->
        <div class="event-card">
            <span class="badge">STARTER</span>
            <h3 class="title">UNLIMITED</h3>
            <p class="price">Rp 1.5jt <span>/bulan</span></p>

            <ul class="benefit">
                <li>Unlimited Kelas</li>
                <li>Semua Jenis Pilates</li>
                <li>2 Private Sessions</li>
                <li>Priority Booking</li>
                <li>VIP Lounge Access</li>
            </ul>
        </div>
    </div>
</section>

<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>


{{-- paket dan harga--}}

<section class="pricing-section">
    <div class="pricing-header">
        <span class="pricing-subtitle">Paket & Harga</span>
        <h2>Pilih Paket yang Sesuai untuk Anda</h2>
        <p>
            Berbagai pilihan paket kelas dengan harga terjangkau.
            Semakin banyak sesi yang Anda ambil, semakin hemat!
        </p>
    </div>

    <div class="pricing-grid">
        <!-- CARD 1 -->
        <div class="pricing-card" data-paket="Mat Pilates & Yoga">
            <h4>Group Class</h4>
            <h3>Mat Pilates & Yoga</h3>
            <p class="desc">Kelas dasar untuk pemula hingga menengah</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp60.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp300.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp480.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Maks 12 peserta per kelas</li>
                <li>Matras tersedia</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>

        <!-- CARD 2 -->
        <div class="pricing-card" data-paket="Chair & Swing Yoga">
            <h4>Group Class</h4>
            <h3>Chair & Swing Yoga</h3>
            <p class="desc">Kelas dengan peralatan khusus</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp80.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp400.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp640.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Alat premium per kelas</li>
                <li>Peralatan lengkap</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>

        <!-- CARD 3 -->
        <div class="pricing-card" data-paket="Chair & Swing Yoga">
            <h4>Group Class</h4>
            <h3>Chair & Swing Yoga</h3>
            <p class="desc">Kelas dengan peralatan khusus</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp80.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp400.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp640.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Alat premium per kelas</li>
                <li>Peralatan lengkap</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>
        <!-- CARD 4 -->
        <div class="pricing-card" data-paket="Chair & Swing Yoga">
            <h4>Group Class</h4>
            <h3>Chair & Swing Yoga</h3>
            <p class="desc">Kelas dengan peralatan khusus</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp80.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp400.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp640.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Alat premium per kelas</li>
                <li>Peralatan lengkap</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>
        <!-- CARD 5 -->
        <div class="pricing-card" data-paket="Chair & Swing Yoga">
            <h4>Group Class</h4>
            <h3>Chair & Swing Yoga</h3>
            <p class="desc">Kelas dengan peralatan khusus</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp80.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp400.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp640.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Alat premium per kelas</li>
                <li>Peralatan lengkap</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>
        <!-- CARD 6 -->
        <div class="pricing-card" data-paket="Chair & Swing Yoga">
            <h4>Group Class</h4>
            <h3>Chair & Swing Yoga</h3>
            <p class="desc">Kelas dengan peralatan khusus</p>

            <ul class="price-list">
                <li><span>1 Sesi</span><strong>Rp80.000</strong></li>
                <li><span>5 Sesi</span><strong>Rp400.000</strong></li>
                <li><span>8 Sesi</span><strong>Rp640.000</strong></li>
            </ul>

            <hr>

            <ul class="benefit-list">
                <li>Instruktur bersertifikat</li>
                <li>Alat premium per kelas</li>
                <li>Peralatan lengkap</li>
                <li>Durasi 60 menit</li>
            </ul>
        </div>
    </div>

    <!-- PROMO (DI LUAR GRID) -->
    <div class="promo-wrapper">
        <div class="promo-box">
            <div class="promo-text">
                <span class="promo-title">Promo Spesial!</span>
                <span class="promo-desc">
                    Beli 5 sesi gratis 1 sesi • Beli 8 sesi gratis 2 sesi
                </span>
            </div>
            <div class="promo-right">
                <button class="btn-select">Pilih Paket</button>
            </div>
        </div>
    </div>
</section>



<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>

{{-- ===================
ABOUT SECTION
===================== --}}

<section id="about" class="about-preview">
    <div class="container about-layout">

        <!-- TEXT -->
        <div class="about-content">
            <h2 class="about-label">About Rens Pilates</h2>
            <p class="about-subtitle">Women only Pilates studio</p>

            <h2 class="about-title">
                Transform your <br> Body & Mind
            </h2>

            <p class="about-desc">
                Rens.Pilates adalah studio pilates premium yang didirikan dengan misi membawa transformasi kesehatan dan
                kebugaran yang holistik.
            </p>

            <p class="about-desc">
                Dengan instruktur bersertifikat internasional, peralatan modern, dan program yang disesuaikan dengan
                kebutuhan Anda, kami hadir untuk mendampingi perjalanan transformasi Anda.
            </p>

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

        <!-- IMAGE -->
        <div class="about-card">
            <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Reformer Pilates">
        </div>

    </div>
</section>

<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>

{{-- FASILITAS --}}
<section id="fasilitas" class="fasilitas-preview">
    <div class="container">
        <span class="section-label">Fasilitas</span>
        <h2>Fasilitas Premium untuk Pengalaman Terbaik</h2>

        <div class="fasilitas-grid">

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 9, 2026, 10_35_35 PM 2.png" alt="Reformer Pilates">
                <div class="fasilitas-text">
                    <h3>Reformer Pilates</h3>
                    <p>Peralatan reformer pilates terbaru dari brand ternama dengan kualitas terbaik</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 9, 2026, 10_40_56 PM 1.png" alt="Private studio">
                <div class="fasilitas-text">
                    <h3>Private Studios</h3>
                    <p>Ruangan private untuk sesi one-on-one dengan privasi</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_04 PM 1.png" alt="Group studio">
                <div class="fasilitas-text">
                    <h3>Group Studios</h3>
                    <p>Studio luas dengan kapasitas hingga 12 orang, dilengkapi AC dan sound system</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_06 PM 1.png" alt="Locker room">
                <div class="fasilitas-text">
                    <h3>Locker Room</h3>
                    <p>Ruang ganti yang bersih dan nyaman dengan locker pribadi</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_07 PM 1.png" alt="Shower Facilities">
                <div class="fasilitas-text">
                    <h3>Shower Facilities</h3>
                    <p>Shower dengan air hangat dan perlengkapan mandi tersedia</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_09 PM 1.png" alt="Lounge area">
                <div class="fasilitas-text">
                    <h3>Lounge Area</h3>
                    <p>Area santai dengan minuman gratis dan WiFi untuk member</p>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>

{{-- COACH --}}
<section id="coach" class="coach-preview">
    <div class="container">
        <h2>Coach</h2>
        <p>Coach Profesional untuk Pengalaman Terbaik</p>
        <div class="coach-grid">
            <div class="coach-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Reformer Pilates">
            </div>

            <div class="coach-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Private studio">
            </div>

            <div class="coach-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Group studio">
            </div>
        </div>
    </div>
</section>

<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>

{{-- FAQ --}}
<section id="faq" class=" faq-preview">
    <div class="container">
        <div class="faq-header">
            <p>FAQ</p>
            <h2>Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="faq-list">
            @php
            $faqs = [
            ['q' => 'Apakah saya perlu pengalaman sebelumnya untuk join kelas?', 'a' => 'Tidak perlu! Kami menyediakan
            kelas untuk semua level, dari pemula hingga advanced. Instruktur kami akan membantu Anda menyesuaikan
            gerakan dengan kemampuan Anda.'],
            ['q' => 'Berapa lama masa berlaku card/paket yang saya beli?', 'a' => 'Card aktif 3 bulan sejak card pertama
            digunakan. Jika belum digunakan, card tidak akan hangus.'],
            ['q' => 'Apakah saya bisa reschedule kelas yang sudah dibooking?', 'a' => 'Ya, Anda bisa reschedule maksimal
            12 jam sebelum kelas dimulai melalui dashboard member.'],
            ['q' => 'Bagaimana jika saya tidak bisa hadir ke kelas yang sudah dibooking?', 'a' => 'Silakan cancel atau
            reschedule minimal 12 jam sebelum kelas. Jika tidak, card Anda tetap akan terpotong.'],
            ['q' => 'Apakah ada promo untuk member baru?', 'a' => 'Ya! Kami memiliki berbagai promo menarik seperti beli
            5 sesi gratis 1 sesi, dan program referral.'],
            ];
            @endphp

            @foreach ($faqs as $faq)
            <div class="faq-item">
                <button class="faq-question">
                    <span>{{ $faq['q'] }}</span>
                    <i class="chevron-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider-wrapper">
    <div class="section-divider"></div>
</div>

{{-- CTA JOIN --}}
<section class="cta">
    <div class="container">
        <h2>Siap Memulai Transformasi Anda?</h2>
        <p>Bergabunglah dengan komunitas Rens.Pilates hari ini!</p>
        <div class="cta-actions">
            <a href="/join-class" class="btn-primary">Join Class Now</a>
            <a href="/paket-harga" class="btn-outline">Lihat Paket & Harga</a>
        </div>
    </div>
</section>



@endsection