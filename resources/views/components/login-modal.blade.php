<div class="modal-badge">Rens.Pilates</div>
<div class="modal-overlay" id="loginModal">
    <div class="modal-box">
        <button class="modal-close" id="closeLogin">&times;</button>

        <h3>Welcome Back</h3>
        <h3 class="judul"> Rens.Pilates</h3>
        <p class="subtitle">Login to your account</p>

        <!-- GOOGLE -->
        <button class="btn-google">
            Sign in with Google
        </button>

        <div class="divider">or</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" required>

            <div class="password-field">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span id="togglePassword">👁</span>
            </div>

            @if ($errors->any())
            <div class="error-text">
                {{ $errors->first() }}
            </div>
            @endif

            <button type="submit" class="btn-login">Login</button>
        </form>
        @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
        @endif
    </div>
</div>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('loginModal').classList.add('active');
});
</script>
@endif