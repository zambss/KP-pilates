<div class="app">
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <a href="/">Rens.Pilates</a>
            </div>
            <ul class="nav-menu">
                <li><a href="#about">About Me</a></li>
                <li><a href="#fasilitas">Fasilitas</a></li>
                <li><a href="#coach">Coach</a></li>
                <li><a href="#event">Event & Promo</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
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
        </div>
    </nav>
</div>