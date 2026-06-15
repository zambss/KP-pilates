@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-wrapper">

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <p>Total Users</p>
            <h3>{{ \App\Models\User::count() }}</h3>
        </div>

        <div class="dashboard-card">
            <p>Total Classes</p>
            <h3>{{ \App\Models\ClassSession::count() ?? 0 }}</h3>
        </div>

        <div class="dashboard-card">
            <p>Total Membership</p>
            <h3>{{ \App\Models\Membership::count() ?? 0 }}</h3>
        </div>

    </div>

    <div class="dashboard-info">
        <h5>Selamat datang di Admin Dashboard 🧘</h5>
        <p>Kelola user, kelas, dan membership di sini.</p>
    </div>

</div>

@endsection