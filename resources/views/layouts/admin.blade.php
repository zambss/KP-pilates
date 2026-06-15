<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/absenn.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/classes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/membership.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/packages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/packages-item.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/coach.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/studio.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/prices.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/norek.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>

    <div class="flex">

        <!-- SIDEBAR -->
        @include('admin.komponen.sidebar')

        <!-- CONTENT -->
        <div class="ml-64 w-full">

            @include('admin.komponen.header')

            <div class="p-6">
                @yield('content')
            </div>

        </div>

    </div>

    <script defer src="{{ asset('js/admin/mod.js') }}"></script>
    @yield('scripts')
</body>

</html>