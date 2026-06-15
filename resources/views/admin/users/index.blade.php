@extends('layouts.admin')

@section('title', 'Data User')

@section('content')

<div class="user-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="user-header">
            <h4 class="user-title">Data User</h4>
            <a href="{{ route('users.create') }}" class="btn-add">
                + Tambah User
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>

                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection