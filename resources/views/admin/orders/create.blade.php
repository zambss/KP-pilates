@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow p-6">

        <h4 class="text-lg font-semibold mb-6">➕ Tambah Order</h4>

        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <!-- USER -->
            <div class="mb-4">
                <label class="block mb-1">User</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- CLASS -->
            <div class="mb-4">
                <label class="block mb-1">Class</label>
                <select name="class_id" class="form-control">
                    @foreach($classes as $c)
                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- PRICE -->
            <div class="mb-4">
                <label class="block mb-1">Harga</label>
                <input type="number" name="price" class="form-control" placeholder="Masukkan harga">
            </div>

            <!-- SESSION -->
            <div class="mb-6">
                <label class="block mb-1">Jumlah Sesi</label>
                <input type="number" name="total_sessions" class="form-control" placeholder="Contoh: 6">
            </div>

            <div class="flex gap-2">
                <button class="btn-primary-custom px-4">Simpan</button>

                <a href="{{ route('orders.index') }}" class="btn-outline-custom px-4">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection