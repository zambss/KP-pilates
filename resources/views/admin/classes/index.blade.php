@extends('layouts.admin')

@section('title', 'Classes')

@section('content')

<div class="classes-card">

    <!-- HEADER -->
    <div class="classes-header">
        <h4>Data Classes</h4>

        <a href="{{ route('classes.create') }}" class="btn-add">
            + Tambah Class
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="table-wrapper">

        <table class="classes-table">

            <thead>
                <tr>
                    <th>Nama Class</th>
                    <th>Category</th>
                    <th>Deskripsi</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($classes as $class)
                <tr>

                    <td>{{ $class->title }}</td>

                    <td>
                        <span class="badge-soft">
                            {{ $class->category }}
                        </span>
                    </td>

                    <td class="text-muted">
                        {{ $class->description }}
                    </td>

                    <td>
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('classes.delete', $class->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete" onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada data class
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection