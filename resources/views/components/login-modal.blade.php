<!-- LOGIN MODAL -->
<div class="modal-overlay" id="loginModal">

    <!-- BADGE -->
    <div class="modal-badge">Rens.Pilates</div>

    <!-- MODAL BOX -->
    <div class="modal-box">

        <!-- CLOSE -->
        <button class="modal-close" id="closeLogin" aria-label="Close modal">
            &times;
        </button>

        <!-- HEADER -->
        <h3 class="welcome-title">Welcome Back</h3>
        <h3 class="judul">Rens.Pilates</h3>
        <p class="subtitle">Login to your account</p>

        <!-- GOOGLE LOGIN (UI ONLY) -->
        <button class="btn-google" type="button">
            Sign in with Google
        </button>

        <div class="divider">or</div>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <input type="email" name="email" placeholder="Email" required autocomplete="email">

            <div class="password-field">
                <input type="password" name="password" id="password" placeholder="Password" required
                    autocomplete="current-password">
                <span id="togglePassword" role="button" aria-label="Toggle password">
                    👁
                </span>
            </div>

            <!-- ERROR MESSAGE -->
            @if ($errors->any())
            <div class="error-text">
                {{ $errors->first() }}
            </div>
            @endif

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

    </div>
</div>