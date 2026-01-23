@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('content')

<div class="dashboard-header">
    <h1>Profile</h1>
    <p>Kelola informasi akun dan preferensi Anda</p>
</div>

<section class="section profile-wrapper">

    <div class="profile-card">

        <!-- HEADER PROFILE -->
        <div class="profile-header">
            KA {{ session('customer_name') }}
        </div>

        <div class="profile-info">
            <h3>{{ session('customer_name') }}</h3>
            <p>Member ID · {{ session('customer_id') ?? '-' }}</p>
        </div>
    </div>

    <!-- FORM PROFILE -->
    <form class="profile-form">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" input : {{ session('customer_name') }}>
        </div>

        <div class=" form-group">
            <label>Email</label>
            <input type="email" value="katrina@email.com">
        </div>

        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" value="08xxxxxxxxxx">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="password" value="********">
        </div>

        <div class="form-group">
            <label>Catatan kesehatan</label>
            <input type="password" value="********">
        </div>

        <div class="form-group">
            <label>Kontak darurat</label>
            <input type="password" value="********">
        </div>

        <div class="form-group">
            <label>Status</label>
            <input type="password" value="********">
        </div>


    </form>

    </div>

</section>

@endsection