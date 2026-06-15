@extends('layouts.admin')

@section('title', 'Promo Orders')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- =========================
         HEADER
    ========================== -->
    <div class="mb-6">

        <h3 class="text-lg font-semibold">
            🎁 Promo Orders
        </h3>

    </div>



    <!-- =========================
         SUCCESS ALERT
    ========================== -->
    @if(session('success'))

    <div class="mb-4 p-3 rounded bg-gray-100 text-sm">

        {{ session('success') }}

    </div>

    @endif



    <!-- =========================
         TABLE CARD
    ========================== -->
    <div class="table-card">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>User</th>

                    <th>Paket</th>

                    <th>Harga</th>

                    <th>Bukti Transfer</th>

                    <th>Status</th>

                    <th width="180">
                        Aksi
                    </th>

                </tr>

            </thead>



            <tbody>

                @forelse($orders as $o)

                <tr>

                    <!-- USER -->
                    <td class="fw-semibold">

                        {{ $o->user->name }}

                    </td>



                    <!-- PACKAGE -->
                    <td>

                        <span class="badge-soft">

                            {{ $o->package->name }}

                        </span>

                    </td>



                    <!-- PRICE -->
                    <td>

                        Rp {{ number_format($o->price, 0, ',', '.') }}

                    </td>



                    <!-- PAYMENT PROOF -->
                    <td>

                        @if($o->payment_proof)

                        <a href="{{ asset('storage/' . $o->payment_proof) }}" target="_blank"
                            class="btn-outline-custom btn-sm">
                            Lihat Bukti
                        </a>

                        @else

                        <span class="text-muted text-sm">
                            Belum Upload
                        </span>

                        @endif

                    </td>



                    <!-- STATUS -->
                    <td>

                        <span class="status-badge 
                                {{ $o->status == 'pending' ? 'pending' : '' }}
                                {{ $o->status == 'approved' ? 'active' : '' }}
                                {{ $o->status == 'rejected' ? 'expired' : '' }}">

                            {{ strtoupper($o->status) }}

                        </span>

                    </td>



                    <!-- ACTION -->
                    <td>

                        @if($o->status == 'pending')

                        <div class="flex gap-2">

                            <!-- APPROVE -->
                            <form action="{{ route('package-orders.approve', $o->id) }}" method="POST">

                                @csrf

                                <button class="btn-primary-custom btn-sm">

                                    ✔

                                </button>

                            </form>



                            <!-- REJECT -->
                            <form action="{{ route('package-orders.reject', $o->id) }}" method="POST">

                                @csrf

                                <button class="btn-outline-custom btn-sm">

                                    ✖

                                </button>

                            </form>

                        </div>

                        @else

                        <span class="text-muted text-sm">

                            Done

                        </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-4 text-muted">

                        Belum ada promo order

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection