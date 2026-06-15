@extends('layouts.admin')

@section('title', 'Data Hero')

@section('content')

<div class="user-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="user-header">
            <h4 class="user-title">Data Hero</h4>
            <a href="{{ route('admin.hero.create') }}" class="btn-add">
                + Tambah Hero
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="user-table">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Title</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($heroes as $hero)
            <tr>
                <td><img src="{{ asset('storage/'.$hero->image) }}" width="80"></td>
                <td>{{ $hero->title }}</td>
                <td>
                    <a href="{{ route('admin.hero.edit',$hero->id) }}" class="btn-edit">Edit</a>

                    <form action="{{ route('admin.hero.destroy',$hero->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection