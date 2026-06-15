
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/pricelist.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
    <link rel="stylesheet" href="{{ asset('css/schedule-modal.css') }}">

    {{-- JS --}}
    <script src="{{ asset('js/schedule-modal.js') }}"></script>
     <script src="{{ asset('js/modal.js') }}"></script>
</head>

<body>

    <button class="hamburger" id="hamburger">
        <i class="fas fa-bars"></i>
    </button>

    <div class="dashboard-wrapper">
        @include('components.dashboard.sidebar')

        <main class="dashboard-content">
            @yield('content')
        </main>
    </div>

    {{-- =========================
   POPUP BOOKING
========================= --}}
@if(session('booking_popup'))
<div class="popup-overlay active" id="bookingPopup">
    <div class="popup-card">

        <div class="popup-header">
            <h3>
                {{ session('booking_status') === 'success' ? 'Berhasil' : 'Gagal' }}
            </h3>
            <button onclick="closeBookingPopup()">×</button>
        </div>

        <div class="popup-body">
            <p>{{ session('booking_message') }}</p>
        </div>

        <div class="popup-footer">
            <button class="btn-primary" onclick="closeBookingPopup()">
                OK
            </button>
        </div>

    </div>
</div>
@endif

<script>
function closeBookingPopup() {
    const popup = document.getElementById('bookingPopup');
    if (popup) popup.remove(); // 🔥 hilang total
}
</script>
@stack('scripts')
    <script>
        
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.querySelector('.sidebar');

    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
    </script>

</body>

</html>