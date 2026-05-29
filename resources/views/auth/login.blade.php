<style>
/* ===== AUTH PAGE CLEAN SYSTEM ===== */

body {
    background: #0f2438;
}

/* center wrapper */
.auth-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
}

/* card */
.auth-card {
    width: 420px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    overflow: hidden;
}

/* header */
.auth-header {
    background: linear-gradient(135deg, #102a43, #163a57);
    padding: 26px;
    text-align: center;
}

.auth-logo {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
}

.auth-logo span {
    color: #7dd3a7;
}

.auth-subtitle {
    font-size: 13px;
    color: rgba(255,255,255,0.75);
    margin-top: 6px;
}

/* body */
.auth-body {
    padding: 28px;
}

/* form spacing SYSTEM (IMPORTANT) */
.auth-form {
    display: flex;
    flex-direction: column;
    gap: 18px; /* controls ALL vertical spacing */
}

/* field group */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px; /* label → input spacing */
}

/* label */
label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

/* inputs */
.auth-card input[type="email"],
.auth-card input[type="password"] {
    width: 100%;
    border-radius: 10px;
    border: 1px solid #a1b5ce;
    padding: 11px 12px;
    outline: none;
    transition: 0.25s ease;
}

.auth-card input:focus {
    border-color: #2a9d8f;
    box-shadow: 0 0 0 3px rgba(42,157,143,0.15);
}

/* checkbox row */
.auth-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

/* links */
.auth-card a {
    color: #2a9d8f;
    text-decoration: none;
}

.auth-card a:hover {
    color: #184e3b;
}

/* button */
.auth-btn {
    width: 100%;
    background: #2a9d8f !important;
    border-radius: 10px;
    padding: 12px;
    font-weight: 600;
    color: #fff;
    transition: 0.25s ease;
}

.auth-btn:hover {
    background: #238b7e !important;
    transform: translateY(-1px);
}

/* footer */
.auth-footer {
    text-align: center;
    font-size: 13px;
    color: #6b7280;
}

/* mobile */
@media (max-width: 480px) {
    .auth-card {
        width: 100%;
    }
}
</style>

<div class="auth-wrapper">

    <div class="auth-card">

        <!-- Header -->
        <div class="auth-header">
            <div class="auth-logo">
                Mini <span>Store</span>
            </div>
            <div class="auth-subtitle">
                Sign in to manage your store
            </div>
        </div>

        <!-- Body -->
        <div class="auth-body">

            <x-auth-session-status class="mb-2" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                        class="block w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password"
                        class="block w-full"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <!-- Options -->
                <div class="auth-options">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button type="submit" class="auth-btn">
                    Log in
                </button>

                <!-- Footer -->
                <div class="auth-footer">
                    Don’t have an account?
                    <a href="{{ route('register') }}">
                        register Here!!
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>