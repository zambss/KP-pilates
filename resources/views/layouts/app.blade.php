<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Pilates' }}</title>
    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" href="/css/booking.css">
    <link rel="stylesheet" href="/css/receipt.css">
    @stack('styles')
</head>

<body>

    @yield('content')

    @stack('scripts')
</body>

</html>