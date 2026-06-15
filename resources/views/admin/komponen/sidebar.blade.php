<div class="sidebar">

    <div class="sidebar-title">
        Admin Panel
    </div>

    <ul class="sidebar-menu">

        <!-- CORE -->
        <li class="sidebar-section">Core</li>

        <li>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>

        <li>
            <a href="{{ route('admin.hero.index') }}">Hero</a>
        </li>
        <li>
            <a href="{{ route('admin.about.index') }}">About</a>
        </li>
        <li>
            <a href="{{ route('admin.facility.index') }}">Fasilitas</a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">Users</a>
        </li>

        <li>
            <a href="{{ route('profiles.index') }}">User Profile</a>
        </li>

        <!-- MANAGEMENT -->
        <li class="sidebar-section">Management</li>

        <li>
            <a href="{{ route('classes.index') }}">Classes</a>
        </li>

        <li>
            <a href="{{ route('coaches.index') }}">Coaches</a>
        </li>

        <li>
            <a href="{{ route('studio.index') }}">Studio</a>
        </li>

        <li>
            <a href="{{ route('memberships.index') }}">Membership</a>
        </li>

        <li>
            <a href="{{ route('packages.index') }}">Packages</a>
        </li>

        <li>
            <a href="{{ route('package-items.index') }}">Package Items</a>
        </li>

        <li>
            <a href="{{ route('prices.index') }}">Prices</a>
        </li>

        <!-- TRANSACTION -->
        <li class="sidebar-section">Transaction</li>

        <li>
            <a href="{{ route('bookings.index') }}">Bookings</a>
        </li>

        <li>
            <a href="{{ route('orders.index') }}">Orders</a>
        </li>

        <li>
            <a href="{{ route('package-orders.index') }}">Promo Orders</a>
        </li>

        <!-- SYSTEM -->
        <li class="sidebar-section">System</li>

        <a href="{{ route('payment.index') }}">
            Pengaturan Rekening
        </a>

        <li>
            <a href="{{ route('admin.schedule') }}">Calendar</a>
        </li>

        <li>
            <a href="{{ route('attendances.index') }}">Absensi</a>
        </li>
        <!-- LOGOUT -->
        <li class="mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="sidebar-logout">Logout</button>
            </form>
        </li>

    </ul>

</div>