<nav class="navbar">
    <div class="navbar-container">

        <div class="logo">
            <a href="/">Rens.Pilates</a>
        </div>
        <!-- HAMBURGER -->
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            ☰
        </button>
        <!-- MENU -->
        <ul class="nav-menu" id="navMenu">
            <li><a href="#event">Event & Promo</a></li>
            <li><a href="#paket&harga">Paket & Harga</a></li>
            <li><a href="#about">About Rens</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <li><a href="#coach">Coach</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact</a></li>
            {{-- =========================
                 AUTH SECTION (FIXED)
                 ========================= --}}

            @auth
            <li class="user-menu">
                <a href="{{ route('dashboardLogin.index') }}" class="btn-login user-link">
                    {{ Auth::user()->name }}
                </a>
            </li>
            @else
            <li>
                <button type="button" class="btn-login open-login">
                    Login
                </button>
            </li>
            @endauth

        </ul>

    </div>
</nav>

<script src="{{ asset('js/modal.js') }}"></script>