@extends('layouts.dashboard')

@section('content')

{{-- =========================
   HEADER
========================= --}}
<div class="dashboard-header">

    <h1>
        Dashboard Transaksi
    </h1>

    <p>
        Ringkasan paket, sesi, dan transaksi Anda
    </p>

</div>



{{-- =========================
   RIWAYAT TRANSAKSI
========================= --}}
<div class="dashboard-section">

    <div class="section-header">

        <h3>
            Riwayat Transaksi
        </h3>

        <p>
            Pembelian paket kelas
        </p>

    </div>



    {{-- =========================
       TABLE
    ========================= --}}
    <div class="transaction-table">


        {{-- HEADER --}}
        <div class="transaction-row transaction-head">

            <div>ID</div>

            <div>Tipe</div>

            <div>Nama Paket</div>

            <div>Sesi</div>

            <div>Harga</div>

            <div>Tanggal</div>

            <div>Status</div>

        </div>



        {{-- CONTENT --}}
        @forelse($transactions as $trx)

        <div class="transaction-row">

            {{-- ID --}}
            <div class="trx-id">

                #{{ $trx['id'] }}

            </div>



            {{-- TYPE --}}
            <div>

                {{ $trx['type'] }}

            </div>



            {{-- NAME --}}
            <div class="trx-name">

                {{ $trx['name'] }}

            </div>



            {{-- SESSION --}}
            <div>

                @if($trx['sessions'])

                {{ $trx['sessions'] }} sesi

                @else

                Paket

                @endif

            </div>



            {{-- PRICE --}}
            <div class="trx-price">

                Rp {{ number_format($trx['price'], 0, ',', '.') }}

            </div>



            {{-- DATE --}}
            <div class="trx-date">

                <div>

                    {{ \Carbon\Carbon::parse($trx['date'])->format('d M Y') }}

                </div>

                <small>

                    {{ \Carbon\Carbon::parse($trx['date'])->format('H:i:s') }}

                </small>

            </div>



            {{-- STATUS --}}
            <div>

                <span class="status {{ $trx['status'] }}">

                    {{ ucfirst($trx['status']) }}

                </span>

            </div>

        </div>

        @empty

        <div class="empty-state">

            <p>
                Belum ada transaksi
            </p>

        </div>

        @endforelse

    </div>

</div>

@endsection