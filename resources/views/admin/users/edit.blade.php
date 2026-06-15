@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">✏️ Edit User</h4>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-input">
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-input">
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-input">
                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin
                    </option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password (opsional)</label>
                <input type="password" name="password" class="form-input">
            </div>

            <!-- BUTTON -->
            <div class="form-actions flex gap-2">
                <button class="btn-primary-custom">Update</button>

                <a href="{{ route('users.index') }}" class="btn-outline-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection