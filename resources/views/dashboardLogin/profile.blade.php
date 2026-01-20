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
            <div class="profile-avatar">
                KA
            </div>

            <div class="profile-info">
                <h3>Katrina Angelica</h3>
                <p>Member ID: 123-1-1</p>
            </div>
        </div>

        <!-- FORM PROFILE -->
        <form class="profile-form">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" value="Katrina Angelica">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="katrina@email.com">
            </div>

            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" value="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" value="********">
            </div>

        </form>

    </div>

</section>

@endsection