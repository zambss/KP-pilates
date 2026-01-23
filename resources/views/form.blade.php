@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header">
        <h2>Kalender & Jadwal Kelas</h2>
        <p>Kelola jadwal dan booking kelas Anda (maksimal 2 minggu ke depan)</p>
    </div>

    <form id="registrationForm" method="POST" action="#">
        @csrf

        <div class="form-card">

            <!-- JUDUL FORM -->
            <h3>SURAT PERSETUJUAN DAN PELEPASAN TANGGUNG JAWAB PESERTA KELAS PILATES</h3>

            <p class="form-intro">
                Yang bertanda tangan di bawah ini, saya:
            </p>

            <!-- FIELD FORM -->
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat">
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="nomor_telepon">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>Catatan Kesehatan</label>
                <input type="text" name="catatan_kesehatan">
            </div>

            <div class="form-group">
                <label>Kontak Darurat</label>
                <input type="text" name="kontak_darurat">
            </div>

            <div class="form-group">
                <label>Nama dan Status (Anton sebagai Suami)</label>
                <input type="text" name="hubungan">
            </div>

            <!-- PERNYATAAN (DI BAWAH LABEL, SESUAI GAMBAR) -->
            <div class="form-group">
                <label>Pernyataan Persetujuan</label>

                <div class="agreement-box">
                    <p>
                        Menyatakan secara sadar dan sungguh-sungguh menyetujui hal-hal berikut
                        terkait partisipasi saya dalam kelas pilates yang diselenggarakan oleh
                        RENS Pilates & Wellness:
                    </p>

                    <ul>
                        <li>
                            Saya menyatakan bahwa saya berada dalam kondisi fisik yang sehat dan tidak memiliki kondisi
                            medis atau cedera yang dapat membahayakan partisipasi saya dalam kelas, kecuali yang telah
                            saya sampaikan secara tertulis kepada instruktur.
                        </li>

                        <li>
                            Saya memahami bahwa aktivitas fisik ini bukan merupakan pengganti diagnosis atau perawatan
                            medis, dan memiliki risiko cedera tertentu, seperti ketegangan otot, keseleo, atau cedera
                            lain yang mungkin terjadi selama latihan.
                        </li>

                        <li>
                            Saya setuju untuk segera memberi tahu instruktur jika ada perubahan kondisi kesehatan saya
                            ataujika saya merasa tidak nyaman/sakit selama kelas berlangsung. Dan instruktur berhak
                            meminta saya berhenti melakukan gerakan tertentu atau menghentikan partisipasi saya jika
                            dianggap perlu demi keselamatan saya.
                        </li>

                        <li>
                            Saya secara sukarela memilih untuk berpartisipasi dalam kelas-kelas ini dan menanggung semua
                            risiko yang melekat tersebut.
                        </li>

                        <li>
                            Saya melepaskan hak untuk menuntut atau meminta pertanggungjawaban hukum dari RENS Pilates &
                            Wellness, pemilik, karyawan, atau agennya, atas cedera fisik, kerugian properti, atau
                            kerusakan lain yang mungkin saya alami akibat partisipasi saya dalam kelas pilates, kecuali
                            jika cedera tersebut disebabkan oleh kelalaian berat atau kesalahan disengaja dari pihak
                            studio/instruktur.
                        </li>

                        <li>
                            Saya bersedia mematuhi semua aturan, kebijakan, dan instruksi yang diberikan oleh instruktur
                            selama kelas berlangsung, termasuk kebijakan pembatalan dan pembayaran.
                        </li>

                        <li>
                            Pembatalan atau perubahan jadwal kelas kurang dari 12 jam tidak
                            diperbolehkan.
                        </li>
                    </ul>

                    <p>
                        Demikian surat pernyataan ini saya buat dengan sebenarnya, tanpa paksaan
                        dari pihak manapun, dan agar dapat digunakan sebagaimana mestinya.
                    </p>
                </div>
            </div>

        </div>

        <!-- ACTION BUTTON -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn-back">
                ← Kembali ke Beranda
            </a>

            <button type="submit" class="btn-next">
                Lanjut Pembayaran
            </button>
        </div>

    </form>
</div>
@endsection