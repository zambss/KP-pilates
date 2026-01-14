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
            <div class="hero-right">
                <div class="class-card">
                    <img src="image/Screenshot 2026-01-08 204300 1.png" alt="Reformer Pilates">
                    <div class="card-info">
                        <h4>Reformer Pilates</h4>
                        <p>Today, 10:00 AM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- EVENT & PROMO --}}
<section class="event-preview">
    <div class="container">
        <h2>Event & Promo</h2>
        <h2>jangan lewatkan event dan promo menarik</h2>
        <p>Ikuti event spesial dan manfaatkan promo eksklusif kami</p>
        <a href="/event">Lihat Event</a>
        <div class="event-card">
            <img src="image/image 1.png" alt="Reformer Pilates">
        </div>
    </div>
</section>


{{-- paket dan harga--}}
<section class=" paket-preview">
    <div class="container">
        <h2>Paket & Harga</h2>
        <h2>Pilih Paket yang Sesuai untuk Anda</h2>
        <p>
            Berbagai pilihan paket kelas dengan harga terjangkau.
            Semakin banyak sesi yang Anda ambil, semakin hemat!
        </p>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Join Class Now</a>
            <a href="#" class="btn-outline">Become a Member</a>
        </div>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Join Class Now</a>
            <a href="#" class="btn-outline">Become a Member</a>
        </div>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Join Class Now</a>
            <a href="#" class="btn-outline">Become a Member</a>
        </div>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Join Class Now</a>
            <a href="#" class="btn-outline">Become a Member</a>
        </div>
    </div>
</section>


{{-- ABOUT PREVIEW --}}
<section class=" about-preview">
    <div class="container">
        <h2>About Me</h2>
        <p>Women nly Pilates studio</p>
        <h2> Transform your <br> Body & Mind </h2>
        <p>
            Rens.Pilates adalah studio pilates premium yang didirikan dengan misi membawa transformasi kesehatan dan
            kebugaran yang holistik. Kami percaya bahwa setiap individu memiliki potensi untuk mencapai versi terbaik
            dari diri mereka.
        </p>
        <br>
        <p>
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
            <a href="/about" class="btn-secondary">Read More</a>
        </div>
</section>

{{-- FASILITAS --}}
<section class="fasilitas-preview">
    <div class="container">
        <h1>Fasilitas</h1>
        <h2>Fasilitas Premium untuk Pengalaman Terbaik</h2>
        <div class="fasilitas-grid">
            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 9, 2026, 10_35_35 PM 2.png" alt="Reformer Pilates">
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 9, 2026, 10_40_56 PM 1.png" alt="Private studio">
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_04 PM 1.png" alt="Group studio">
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_06 PM 1.png" alt="Locker room">
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_07 PM 1.png" alt="Shower Facilities">
            </div>

            <div class="fasilitas-card">
                <img src="image/ChatGPT Image Jan 11, 2026, 08_47_09 PM 1.png" alt="Lounge area">
            </div>
        </div>
</section>

{{-- COACH --}}
<section class="coach-preview">
    <div class="container">
        <h2>Coach</h2>
        <p>Coach Profesional untuk Pengalaman Terbaik</p>
        <div class="fasilitas-grid">
            <div class="fasilitas-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Reformer Pilates">
            </div>

            <div class="fasilitas-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Private studio">
            </div>

            <div class="fasilitas-card">
                <img src="image/Screenshot 2026-01-08 192955 4.png" alt="Group studio">
            </div>
        </div>
    </div>
</section>



{{-- FAQ --}}
{{-- FAQ --}}
<section class="faq-preview">
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