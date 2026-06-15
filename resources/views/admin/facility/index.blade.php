@extends('layouts.admin')

@section('title', 'Data Fasilitas')

@section('content')

<div class="user-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="user-header">
            <h4 class="user-title">Data Fasilitas</h4>
            <a href="{{ route('admin.facility.create') }}" class="btn-add">
                + Tambah Fasilitas
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($facilities as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$item->image) }}" width="80">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>

                        <a href="{{ route('admin.facility.edit',$item->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.facility.destroy',$item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete">Hapus</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection