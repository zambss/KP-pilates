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
        <form>
            <input type="text" placeholder="Username / Email">

            <div class="password-field">
                <input type="password" id="password" placeholder="Password">
                <span id="togglePassword">👁</span>
            </div>
            <div class="forgot-password">
                <a href="#">Lupa password?</a>
            </div>

            <button class="btn-login">Login</button>
        </form>

    </div>
</div>