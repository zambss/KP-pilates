@extends('layouts.admin')

@section('content')

<div class="payment-wrapper">

    <h2>
        Pengaturan Rekening
    </h2>

    @if($payment)

    <form action="{{ route('payment.update', $payment->id) }}" method="POST" class="payment-form">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>
                Nama Bank
            </label>

            <input type="text" name="bank_name" value="{{ $payment->bank_name }}">

        </div>



        <div class="form-group">

            <label>
                Nomor Rekening
            </label>

            <input type="text" name="account_number" value="{{ $payment->account_number }}">

        </div>



        <div class="form-group">

            <label>
                Atas Nama
            </label>

            <input type="text" name="account_name" value="{{ $payment->account_name }}">

        </div>



        <button type="submit">

            Update Rekening

        </button>

    </form>

    @else

    <form action="{{ route('payment.store') }}" method="POST" class="payment-form">

        @csrf

        <div class="form-group">

            <label>
                Nama Bank
            </label>

            <input type="text" name="bank_name">

        </div>



        <div class="form-group">

            <label>
                Nomor Rekening
            </label>

            <input type="text" name="account_number">

        </div>



        <div class="form-group">

            <label>
                Atas Nama
            </label>

            <input type="text" name="account_name">

        </div>



        <button type="submit">

            Simpan Rekening

        </button>

    </form>

    @endif

</div>

@endsection