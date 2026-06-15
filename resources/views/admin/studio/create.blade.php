@extends('layouts.admin')

@section('content')

<h2>Tambah Ruangan</h2>

<form action="{{ route('studio.store') }}" method="POST">

    @csrf

    <div>
        <label>Nama Ruangan</label>

        <input type="text" name="name" required>
    </div>

    <div>
        <label>Kapasitas</label>

        <input type="number" name="capacity" required>
    </div>

    <div>
        <label>
            <input type="checkbox" name="is_active" checked>

            Aktif
        </label>
    </div>

    <button type="submit">
        Simpan
    </button>

</form>

@endsection