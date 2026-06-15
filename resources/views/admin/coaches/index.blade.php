@extends('layouts.admin')

@section('title', 'Coach')

@section('content')

<div class="coach-wrapper">

    <!-- HEADER -->
    <div class="coach-header">
        <h4>🏋️ Coach</h4>

        <a href="{{ route('coaches.create') }}" class="btn-add">
            + Tambah Coach
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- GRID -->
    <div class="coach-grid">

        @foreach($coaches as $c)
        <div class="coach-card">

            <img src="{{ asset('storage/' . $c->photo) }}" class="coach-img">

            <h5>{{ $c->name }}</h5>

            <div class="coach-actions">

                <a href="{{ route('coaches.edit', $c->id) }}" class="btn-edit">
                    Edit
                </a>

                <form action="{{ route('coaches.delete', $c->id) }}" method="POST">
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