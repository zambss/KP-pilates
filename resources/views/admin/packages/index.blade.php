@extends('layouts.admin')

@section('title', 'Packages')

@section('content')

<div class="packages-wrapper">

    <!-- HEADER -->
    <div class="packages-header">
        <h4>🎁 Paket Promo</h4>

        <a href="{{ route('packages.create') }}" class="btn-add">
            + Tambah Paket
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- GRID -->
    <div class="packages-grid">

        @foreach($packages as $p)
        <div class="package-card">

            <h5 class="package-title">{{ $p->name }}</h5>

            <h4 class="package-price">
                Rp {{ number_format($p->price, 0, ',', '.') }}
            </h4>

            <span class="status-badge {{ $p->is_active ? 'active' : 'inactive' }}">
                {{ $p->is_active ? 'Active' : 'Non Active' }}
            </span>

            <div class="package-actions">

                <a href="{{ route('packages.edit', $p->id) }}" class="btn-edit">
                    Edit
                </a>

                <form action="{{ route('packages.delete', $p->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn-delete">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection