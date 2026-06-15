@extends('layouts.app')

@section('content')
<div class="booking-page">

    <div class="booking-wrapper">

        <!-- HEADER -->
        <div class="booking-header">

            <a href="{{ url()->previous() }}" class="back-link">
                ←
            </a>

            <div class="booking-title">

                <h2>
                    Form Data Diri
                </h2>

                <div class="booking-steps">

                    <span class="step active">
                        1
                    </span>

                    <span class="step-line"></span>

                    <span class="step">
                        2
                    </span>

                </div>

            </div>

        </div>


        <!-- BOX -->
        <div class="booking-box">

            <!-- ===================== -->
            <!-- RINGKASAN PACKAGE -->
            <!-- ===================== -->
            <div class="summary-card">

                <p class="summary-date">
                    Pembelian Paket Promo
                </p>

                <div class="summary-route">

                    <strong>
                        {{ $package->name }}
                    </strong>

                </div>

                <ul style="margin-top:10px; padding-left:18px;">

                    @foreach($package->items as $item)

                    <li>
                        {{ $item->session_count }}
                        sesi
                        {{ $item->class->title }}
                    </li>

                    @endforeach

                </ul>

                <p style="margin-top:10px;">

                    Total Pembayaran :

                    <strong>
                        Rp{{ number_format($package->price,0,',','.') }}
                    </strong>

                </p>

            </div>


            <!-- ===================== -->
            <!-- INFORMASI PEMBAYARAN -->
            <!-- ===================== -->
            <div class="form-section">

                <h3>
                    Informasi Pembayaran
                </h3>
                <div class="agreement-box">

                    <p>
                        Silakan lakukan pembayaran melalui transfer bank berikut:
                    </p>

                    <div class="payment-info">

                        <strong>
                            {{ $payment->bank_name ?? '-' }}
                        </strong>

                        <br>

                        No Rekening:
                        <strong>
                            {{ $payment->account_number ?? '-' }}
                        </strong>

                        <br>

                        Atas Nama:
                        <strong>
                            {{ $payment->account_name ?? '-' }}
                        </strong>

                    </div>

                    <p class="payment-note">

                        Setelah transfer dilakukan,
                        admin akan melakukan verifikasi pembayaran terlebih dahulu.

                    </p>

                </div>
            </div>


            <!-- ===================== -->
            <!-- FORM -->
            <!-- ===================== -->
            <form method="POST" action="{{ route('pricelist.buy.package', $package->id) }}"
                enctype="multipart/form-data">

                @csrf


                <!-- DETAIL PESERTA -->
                <div class="form-section">

                    <h3>
                        Detail Peserta
                    </h3>

                    <div class="form-group">

                        <label>
                            Nama Lengkap
                        </label>

                        <input type="text" value="{{ $user->name }}" disabled>

                    </div>

                    <div class="form-group">

                        <label>
                            Nomor Telepon
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" required>

                    </div>

                    <div class="form-group">

                        <label>
                            Alamat
                        </label>

                        <input type="text" name="address" value="{{ old('address', $profile->address) }}" required>

                    </div>

                    <div class="form-group">

                        <label>
                            Catatan Kesehatan
                        </label>

                        <input type="text" name="health_note" value="{{ old('health_note', $profile->health_note) }}">

                    </div>

                    <div class="form-group">

                        <label>
                            Kontak Darurat
                        </label>

                        <input type="text" name="emergency_contact"
                            value="{{ old('emergency_contact', $profile->emergency_contact) }}" required>

                    </div>

                </div>

                <!-- ===================== -->
                <!-- PERSETUJUAN -->
                <!-- ===================== -->
                <div class="form-section agreement-section">

                    <h3>
                        Pernyataan Persetujuan
                    </h3>

                    <div class="agreement-box">

                        <p>
                            Saya menyatakan data yang saya isi adalah benar,
                            telah melakukan pembayaran,
                            dan bersedia mengikuti seluruh ketentuan
                            RENS Pilates & Wellness.
                        </p>

                    </div>

                    <!-- CHECKBOX -->
                    <div class="form-check-custom">

                        <input type="checkbox" id="agreement" name="agreement" required>

                        <label for="agreement">

                            Saya setuju dengan ketentuan di atas

                        </label>

                    </div>

                    @error('agreement')

                    <small style="color:red;">

                        {{ $message }}

                    </small>

                    @enderror

                </div>
                <!-- ===================== -->
                <!-- UPLOAD BUKTI TRANSFER -->
                <!-- ===================== -->
                <div class="form-section">

                    <h3>
                        Bukti Pembayaran
                    </h3>

                    <div class="form-group">

                        <label>
                            Upload Bukti Transfer
                        </label>

                        <input type="file" name="payment_proof" accept="image/*" required>

                        @error('payment_proof')

                        <small style="color:red;">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                </div>


                <!-- ===================== -->
                <!-- BUTTON -->
                <!-- ===================== -->
                <div class="booking-action">

                    <button type="submit" class="btn-primary">

                        KONFIRMASI PEMBELIAN

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection