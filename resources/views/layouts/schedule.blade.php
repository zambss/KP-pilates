@include('components.schedule.class-modal')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Jadwal Kelas')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
    <link rel="stylesheet" href="{{ asset('css/schedule-modal.css') }}">

    {{-- JS --}}
    <script src="{{ asset('js/schedule-modal.js') }}"></script>

</head>

<body>

    {{-- TIDAK ADA NAVBAR --}}
    {{-- TIDAK ADA SIDEBAR --}}

    <main>
        @yield('content')
    </main>

    {{-- JS khusus schedule (jika perlu) --}}
    <script src="{{ asset('js/schedule.js') }}"></script>
</body>

</html>