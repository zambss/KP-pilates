<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rens Pilates</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- MODAL SCRIPT (WAJIB DI BAWAH) --}}
    <script src="{{ asset('js/modal.js') }}"></script>

</body>

</html>