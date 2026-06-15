@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<div class="orders-wrapper">

    <!-- HEADER -->
    <div class="orders-header">
        <h4>💰 Class Orders</h4>

        <a href="{{ route('orders.create') }}" class="btn-add">
            + Tambah Order
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- SUMMARY -->
    <div class="orders-summary">
        <div class="summary-card">
            <small>Total Order</small>
            <h5>{{ $orders->count() }}</h5>
        </div>
    </div>

    <!-- TABLE -->
    <div class="orders-card">

        <table class="orders-table">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Class</th>
                    <th>Harga</th>
                    <th>Sesi</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($orders as $o)
                <tr>

                    <td>{{ $o->user->name }}</td>

                    <td>
                        <span class="badge-soft">
                            {{ $o->class->title }}
                        </span>
                    </td>

                    <td>
                        Rp {{ number_format($o->price, 0, ',', '.') }}
                    </td>

                    <td>
                        <span class="badge-soft">
                            {{ $o->total_sessions }} sesi
                        </span>
                    </td>

                    <td>
                        <span class="status-badge 
                        {{ $o->status == 'paid' ? 'paid' : ($o->status == 'pending' ? 'pending' : 'failed') }}">
                            {{ strtoupper($o->status) }}
                        </span>
                    </td>

                 <td class="action-cell">

    @if($o->status == 'pending')

        <!-- APPROVE -->
        <form action="{{ route('orders.approve', $o->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn-approve" onclick="return confirm('Approve order ini?')">
                Appro
            </button>
        </form>

        <!-- REJECT -->
        <form action="{{ route('orders.reject', $o->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn-reject" onclick="return confirm('Tolak order ini?')">
                Reject
            </button>
        </form>

    @else
        <span class="text-muted">No Action</span>
    @endif

    <!-- DELETE -->
    <form action="{{ route('orders.delete', $o->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn-delete" onclick="return confirm('Yakin hapus order?')">
            Hapus
        </button>
    </form>

</td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada order
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection