<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>

<body>

    <button class="hamburger" onclick="toggleSidebar()">☰</button>

    <div class="dashboard-wrapper">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/" class="back-home">← Kembali ke Beranda</a>
                <p class="member-area">Member Area</p>

                <div class="member-card">
                    <strong>Katrina Angelica</strong>
                    <span>123-1-1</span>
                </div>
            </div>
            <ul class="sidebar-menu">

                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboardLogin.index') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('calendar') ? 'active' : '' }}">
                    <a href="{{ route('calendar') }}">
                        <i class="fas fa-calendar"></i>
                        <span>Kalender Kelas</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('card') ? 'active' : '' }}">
                    <a href="{{ route('card') }}">
                        <i class="fas fa-credit-card"></i>
                        <span>Card Saya</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('package') ? 'active' : '' }}">
                    <a href="{{ route('package') }}">
                        <i class="fas fa-box"></i>
                        <span>Paket Pilates</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('notification') ? 'active' : '' }}">
                    <a href="{{ route('notification') }}">
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

            </ul>

        </aside>

        {{-- CONTENT --}}
        <main class="dashboard-content">
            @yield('content')
        </main>

    </div>

    <script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }
    </script>

</body>

</html>