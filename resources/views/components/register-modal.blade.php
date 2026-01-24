<!-- REGISTER MODAL -->
<div class="modal-overlay" id="registerModal">

    <div class="modal-box register-box">

        <!-- CLOSE -->
        <button class="modal-close" id="closeRegister">&times;</button>

        <!-- LOGO -->
        <div class="modal-logo">
            <h4>Rens Pilates</h4>
        </div>

        <!-- TITLE -->
        <h3 class="modal-title">Daftar & Mulai Pilates</h3>
        <p class="modal-subtitle">
            Buat akun untuk mengelola kelas dan jadwal Anda
        </p>

        <!-- FORM -->
        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <input type="email" name="email" placeholder="Masukkan email Anda" required>

            <input type="password" name="password" placeholder="Buat kata sandi" required>

            <input type="text" name="name" placeholder="Masukkan nama lengkap" required>

            <div class="phone-group">
                <span>+62</span>
                <input type="text" name="phone" placeholder="Nomor telepon aktif">
            </div>

            <input type="date" name="birth_date" placeholder="Tanggal lahir">

            <input type="text" name="health_note" placeholder="Catatan kesehatan (Opsional)">

            <input type="text" name="emergency_contact" placeholder="Kontak Darurat">

            <input type="text" name="relation" placeholder="Nama dan Status (Anton sebagai Suami)">

            <button type="submit" class="btn-primary">
                Buat Akun
            </button>
        </form>

        <!-- FOOTER -->
        <p class="modal-footer">
            Sudah punya akun?
            <span id="backToLogin" class="link-action">Masuk</span>
        </p>

    </div>
</div>