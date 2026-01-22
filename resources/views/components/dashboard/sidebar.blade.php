{{-- components/dashboard/sidebar.blade.php --}}

<aside class="sidebar">

    <div class="sidebar-header">
        <a href="/" class="back-home">← Kembali ke Beranda</a>
        <p class="member-area">Member Area</p>

        <div class="member-card">
            <strong>Katrina Angelica</strong>
            <span>123-1-1</span>
        </div>
    </div>

    {{-- MENU UTAMA --}}
    <ul class="sidebar-menu">

        <li class="{{ request()->routeIs('dashboardLogin.index') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.index') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('dashboardLogin.calendar') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.calendar') }}">
                <i class="fas fa-calendar"></i>
                <span>Kalender Kelas</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('dashboardLogin.my-card') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.my-card') }}">
                <i class="fas fa-credit-card"></i>
                <span>Card Saya</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('dashboardLogin.package') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.package') }}">
                <i class="fas fa-box"></i>
                <span>Paket Pilates</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('dashboardLogin.notifications') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.notifications') }}">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('dashboardLogin.profile') ? 'active' : '' }}">
            <a href="{{ route('dashboardLogin.profile') }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>

    </ul>

    {{-- LOGOUT (POJOK BAWAH) --}}
    <div class="sidebar-logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

</aside>