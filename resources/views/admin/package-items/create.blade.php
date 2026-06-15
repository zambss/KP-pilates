@extends('layouts.admin')

@section('title', 'Tambah Package Item')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="package-card">

        <h4 class="package-title">➕ Tambah Item Paket</h4>

        <form method="POST" action="{{ route('package-items.store') }}">
            @csrf

            <!-- PACKAGE -->
            <select name="package_id" class="form-input">
                @foreach($packages as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>

            <!-- CLASS -->
            <select name="class_id" class="form-input">
                @foreach($classes as $c)
                <option value="{{ $c->id }}">{{ $c->title }}</option>
                @endforeach
            </select>

            <!-- SESSION -->
            <input type="number" name="session_count" class="form-input" placeholder="Jumlah sesi">

            <!-- BUTTON -->
            <div class="form-actions">
                <button class="btn-primary-custom">Simpan</button>
            </div>

        </form>

    </div>

</div>

@endsection