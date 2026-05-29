<style>
/* ===== AUTH SYSTEM (SHARED STYLE) ===== */

body {
    background: #0f2438;
}

/* wrapper */
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

/* FORM SYSTEM */
.auth-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* field group */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

/* labels */
label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

/* inputs */
.auth-card input[type="text"],
.auth-card input[type="email"],
.auth-card input[type="password"] {
    width: 100%;
    border-radius: 10px;
    border: 1.5px solid #cbd5e1;
    padding: 11px 12px;
    outline: none;
    transition: 0.25s ease;
}

.auth-card input:hover {
    border-color: #94a3b8;
}

.auth-card input:focus {
    border-color: #2a9d8f;
    box-shadow: 0 0 0 3px rgba(42,157,143,0.15);
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

/* links */
.auth-card a {
    color: #2a9d8f;
    text-decoration: none;
}

.auth-card a:hover {
    color: #184e3b;
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
                Create your account
            </div>
        </div>

        <!-- Body -->
        <div class="auth-body">

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name"
                        class="block w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                        class="block w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required />
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

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input id="password_confirmation"
                        class="block w-full"
                        type="password"
                        name="password_confirmation"
                        required />
                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>

                <!-- Button -->
                <button type="submit" class="auth-btn">
                    Create account
                </button>

                <!-- Footer -->
                <div class="auth-footer">
                    Already have an account?
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>