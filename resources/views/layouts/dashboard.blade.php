<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/booking.css">
    <link rel="stylesheet" href="/css/receipt.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    <script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.querySelector('.sidebar');

    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
    </script>

</body>

</html>