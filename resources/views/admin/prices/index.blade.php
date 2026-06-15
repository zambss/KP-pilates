@extends('layouts.admin')

@section('title', 'Prices')

@section('content')

<div class="prices-wrapper">

    <!-- HEADER -->
    <div class="prices-header">
        <h4>💰 Harga Kelas</h4>

        <a href="{{ route('prices.create') }}" class="btn-add">
            + Tambah Harga
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="prices-card">

        <table class="prices-table">

            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Sesi</th>
                    <th>Bonus</th>
                    <th>Total Sesi</th>
                    <th>Harga</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($prices as $p)
                <tr>

                    <td>
                        <span class="badge-soft">
                            {{ $p->class->title }}
                        </span>
                    </td>

                    <td>{{ $p->session_count }}</td>

                    <td class="text-success">
                        +{{ $p->bonus_sessions }}
                    </td>

                    <td>
                        <strong>{{ $p->session_count + $p->bonus_sessions }}</strong>
                    </td>

                    <td>
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </td>

                    <td class="action-cell">

                        <a href="{{ route('prices.edit', $p->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('prices.delete', $p->id) }}" method="POST">
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