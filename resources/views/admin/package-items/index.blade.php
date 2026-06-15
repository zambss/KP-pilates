@extends('layouts.admin')

@section('title', 'Package Items')

@section('content')

<div class="package-items-wrapper">

    <!-- HEADER -->
    <div class="package-items-header">
        <h4>Package Items</h4>

        <a href="{{ route('package-items.create') }}" class="btn-add">
            + Tambah Item
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE CARD -->
    <div class="package-items-card">

        <table class="package-items-table">

            <thead>
                <tr>
                    <th>Paket</th>
                    <th>Kelas</th>
                    <th>Sesi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($items as $i)
                <tr>

                    <td>
                        <span class="badge-soft">
                            {{ $i->package->name }}
                        </span>
                    </td>

                    <td>
                        <span class="badge-soft">
                            {{ $i->class->title }}
                        </span>
                    </td>

                    <td>
                        {{ $i->session_count }} sesi
                    </td>

                    <td class="action-cell">

                        <a href="{{ route('package-items.edit', $i->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('package-items.delete', $i->id) }}" method="POST">
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