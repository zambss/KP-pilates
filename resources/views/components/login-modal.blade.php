<div class="modal-badge">Rens.Pilates</div>
<div class="modal-overlay" id="loginModal">
    <div class="modal-box">
        <button class="modal-close" id="closeLogin">&times;</button>

        <h3>Welcome Back</h3>
        <p class="subtitle">Login to your account</p>

        <!-- LOGIN ROLE -->
        <div class="role-wrapper">
            <div class="role-select">
                <span class="role-item active" data-role="customer">Customer</span>
                <span class="role-divider">/</span>
                <span class="role-item" data-role="coach">Coach</span>
            </div>
            <div class="role-indicator"></div>
        </div>


        <!-- GOOGLE -->
        <button class="btn-google">
            Sign in with Google
        </button>

        <div class="divider">or</div>

        <!-- FORM -->

        <form id="loginForm">
            @csrf

            <input type="text" name="name" id="username" placeholder="Nama kamu" required>

            <input type="text" placeholder="Username / Email" required>

            <div class="password-field">
                <input type="password" id="password" placeholder="Password" required>
                <span id="togglePassword">👁</span>
            </div>

            <button id="openLogin" type="button" class="btn-login">Login</button>
        </form>

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


        >>>>>>> Stashed changes
    </div>
</div>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('loginModal').classList.add('active');
});
</script>
@endif