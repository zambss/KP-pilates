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
            <li><a href="#contact">Paket & Harga</a></li>
            <li><a href="#about">About Rens</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <li><a href="#coach">Coach</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact</a></li>

            @if(session('customer_login'))
            <li class="user-menu">
                <button class="user-btn">
                    {{ session('customer_name') }} ⌄
                </button>

                <div class="user-dropdown">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </li>
            @else
            <li>
                <button id="openLogin" class="btn-login">Login</button>
            </li>
            @endif
        </ul>

    </div>
</nav>