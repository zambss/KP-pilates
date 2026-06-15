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


        <!-- MAIN BOX -->
        <div class="booking-box">

            <!-- SUMMARY -->
            <div class="summary-card">

                <p class="summary-date">
                    Pembelian Kelas
                </p>

                <div class="summary-route">

                    <strong>
                        {{ $class->title }}
                    </strong>

                    <span class="route-arrow">
                        →
                    </span>

                    <strong>
                        {{ $price->session_count }} sesi
                    </strong>

                </div>

                <p style="margin-top:8px">

                    Total:

                    <strong>
                        Rp{{ number_format($price->price, 0, ',', '.') }}
                    </strong>

                </p>

            </div>


            <!-- PAYMENT INFO -->
            <div class="payment-box">

                <h3 class="payment-title">
                    Pembayaran Transfer
                </h3>

                <div class="payment-bank">
                    {{ $payment->bank_name ?? '-' }}
                </div>

                <div class="payment-item">

                    <strong>
                        No Rekening
                    </strong>

                    <span>
                        {{ $payment->account_number ?? '-' }}
                    </span>

                </div>

                <div class="payment-item">

                    <strong>
                        Atas Nama
                    </strong>

                    <span>
                        {{ $payment->account_name ?? '-' }}
                    </span>

                </div>

                <p class="payment-note">
                    Silakan transfer sesuai nominal total pembayaran
                    lalu upload bukti transfer di bawah.
                </p>

            </div>


            <!-- FORM -->
            <form method="POST" action="{{ route('classes.store', $class->id) }}" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="price_id" value="{{ $price->id }}">


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


                <!-- PAYMENT PROOF -->
                <div class="form-section">

                    <h3>
                        Bukti Pembayaran
                    </h3>

                    <div class="form-group">

                        <label>
                            Upload Bukti Transfer
                        </label>

                        <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png" required>

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

                <!-- ACTION -->
                <div class="booking-action">

                    <button type="submit" class="btn-primary">
                        KIRIM PEMBELIAN
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection