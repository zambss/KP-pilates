@extends('layouts.admin')

@section('title', 'Data About')

@section('content')

<div class="user-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="user-header">
            <h4 class="user-title">Data About</h4>
            <a href="{{ route('admin.about.create') }}" class="btn-add">
                + Tambah About
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
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($abouts as $about)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$about->image) }}" width="80">
                    </td>
                    <td>{{ $about->title }}</td>
                    <td>{{ $about->subtitle }}</td>
                    <td>

                        <a href="{{ route('admin.about.edit',$about->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.about.destroy',$about->id) }}" method="POST" style="display:inline;">
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