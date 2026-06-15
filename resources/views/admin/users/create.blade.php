@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah User</h4>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- NAMA -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-input" required>
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-input" required>
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-input">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Simpan</button>

                <a href="{{ route('users.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection