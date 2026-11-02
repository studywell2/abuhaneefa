<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CBT Portal | Abu Haneefah Islamic Academy</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173b4d;
            --blue: #315c72;
            --gold: #d6a84f;
            --light: #f3f7f8;
            --muted: #71818a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--navy);
            background:
                radial-gradient(circle at 10% 15%, rgba(214,168,79,.15), transparent 30%),
                radial-gradient(circle at 90% 85%, rgba(49,92,114,.16), transparent 35%),
                var(--light);
            overflow-x: hidden;
        }

        .background-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(2px);
            opacity: .35;
            pointer-events: none;
            animation: float 9s ease-in-out infinite;
        }

        .shape-one {
            width: 230px;
            height: 230px;
            background: rgba(214,168,79,.25);
            top: -70px;
            left: -60px;
        }

        .shape-two {
            width: 300px;
            height: 300px;
            background: rgba(49,92,114,.12);
            right: -100px;
            bottom: -100px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-25px) rotate(10deg);
            }
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 18px;
            position: relative;
            z-index: 1;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            animation: entrance .8s ease both;
        }

        @keyframes entrance {
            from {
                opacity: 0;
                transform: translateY(35px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: rgba(255,255,255,.94);
            border: 1px solid rgba(255,255,255,.8);
            border-radius: 24px;
            padding: 38px 36px;
            box-shadow: 0 25px 70px rgba(23,59,77,.12);
            backdrop-filter: blur(15px);
            overflow: hidden;
        }

        .academy-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 17px;
            padding: 5px;
            border: 2px solid var(--gold);
            border-radius: 50%;
            transition: transform .5s, box-shadow .5s;
            box-shadow: 0 5px 20px rgba(214,168,79,.15);
        }

        .logo-wrapper:hover {
            transform: rotate(8deg) scale(1.06);
            box-shadow: 0 8px 28px rgba(214,168,79,.35);
        }

        .academy-logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .academy-name {
            font-size: 23px;
            font-weight: 800;
            margin: 0;
            letter-spacing: .3px;
        }

        .academy-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin: 5px 0 0;
        }

        .gold-line {
            width: 55px;
            height: 3px;
            background: var(--gold);
            margin: 20px auto;
            border-radius: 5px;
        }

        .portal-title {
            font-size: 22px;
            font-weight: 750;
            margin: 0 0 7px;
        }

        .portal-description {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        .progress-section {
            margin: 28px 0 25px;
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 700;
            color: #a0abb1;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .progress-labels span.active {
            color: var(--blue);
        }

        .progress-track {
            height: 5px;
            background: #e9eef0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            border-radius: 10px;
            transition: width .6s cubic-bezier(.22,1,.36,1);
        }

        .progress-fill.complete {
            width: 100%;
        }

        .flip-container {
            perspective: 1200px;
            width: 100%;
        }

        .flip-inner {
            position: relative;
            width: 100%;
            transition: transform .75s cubic-bezier(.2,.75,.25,1);
            transform-style: preserve-3d;
        }

        .flip-inner.flipped {
            transform: rotateY(180deg);
        }

        .form-face {
            width: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .password-face {
            position: absolute;
            inset: 0;
            transform: rotateY(180deg);
        }

        .step-heading {
            font-size: 20px;
            font-weight: 750;
            margin: 0 0 7px;
        }

        .step-description {
            color: var(--muted);
            font-size: 13px;
            margin: 0 0 25px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
            color: var(--navy);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: #82949d;
            pointer-events: none;
            transition: color .3s;
        }

        .form-input {
            width: 100%;
            padding: 15px 45px 15px 45px;
            border: 1.5px solid #e0e7eb;
            border-radius: 12px;
            font-size: 14px;
            color: var(--navy);
            background: #fbfcfd;
            outline: none;
            transition: all .3s ease;
        }

        .form-input:hover {
            border-color: #a7bac4;
            background: white;
        }

        .form-input:focus {
            border-color: var(--blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(49,92,114,.10);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--gold);
        }

        .password-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #71818a;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            padding: 7px;
        }

        .password-toggle:hover {
            color: var(--blue);
        }

        .action-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(120deg, var(--navy), var(--blue));
            color: white;
            font-size: 14px;
            font-weight: 750;
            cursor: pointer;
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(23,59,77,.22);
            background: linear-gradient(120deg, var(--blue), var(--navy));
        }

        .action-button:active {
            transform: translateY(0);
        }

        .button-arrow {
            display: inline-block;
            margin-left: 8px;
            transition: transform .3s;
        }

        .action-button:hover .button-arrow {
            transform: translateX(5px);
        }

        .back-button {
            display: block;
            width: 100%;
            background: transparent;
            border: none;
            color: var(--blue);
            padding: 14px 10px 0;
            font-size: 13px;
            font-weight: 650;
            cursor: pointer;
            transition: color .3s;
        }

        .back-button:hover {
            color: var(--gold);
        }

        .message {
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
            animation: entrance .4s ease;
        }

        .error-message {
            background: #fff0f0;
            color: #a52626;
            border-left: 4px solid #d9534f;
        }

        .success-message {
            background: #edf9f0;
            color: #216b37;
            border-left: 4px solid #39a85a;
        }

        .security-note {
            text-align: center;
            margin: 28px 0 0;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.7;
        }

        .security-icon {
            color: #3b9461;
            margin-right: 5px;
        }

        .website-link {
            display: block;
            text-align: center;
            margin-top: 17px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 650;
            color: var(--blue);
            transition: all .3s;
        }

        .website-link:hover {
            color: var(--gold);
            transform: translateY(-2px);
        }

        .copyright {
            text-align: center;
            color: #9aa7ad;
            font-size: 11px;
            margin-top: 22px;
        }

        @media(max-width: 520px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 19px;
            }

            .academy-name {
                font-size: 21px;
            }

            .logo-wrapper {
                width: 85px;
                height: 85px;
            }
        }

        @media(prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div class="background-shape shape-one"></div>
    <div class="background-shape shape-two"></div>

    <main class="login-wrapper">

        <div class="login-container">

            <section class="login-card">

                <header class="academy-header">

                    <div class="logo-wrapper">
                        <img
                            src="{{ asset('images/logo.jpg') }}"
                            alt="Abu Haneefah Islamic Academy Logo"
                            class="academy-logo"
                        >
                    </div>

                    <h1 class="academy-name">Abu Haneefah</h1>

                    <p class="academy-subtitle">
                        Islamic Academy
                    </p>

                    <div class="gold-line"></div>

                    <h2 class="portal-title">CBT Examination Portal</h2>

                    <p class="portal-description">
                        Your gateway to secure online examinations.
                    </p>

                </header>

                @if (session('success'))
                    <div class="message success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="message error-message" role="alert">
                        @foreach ($errors->all() as $error)
                            <p style="margin:0 0 5px;">
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <div class="progress-section">

                    <div class="progress-labels">
                        <span id="emailLabel">01 — Login ID</span>
                        <span id="passwordLabel">02 — Password</span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('cbt.login.submit') }}"
                    id="loginForm"
                >

                    @csrf

                    <div class="flip-container">

                        <div
                            class="flip-inner"
                            id="flipInner"
                            data-initial-step="{{ $errors->any() && old('identifier') ? 'password' : 'email' }}"
                        >

                            <!-- STEP 1: LOGIN ID -->

                            <div class="form-face email-face">

                                <h3 class="step-heading">
                                    Welcome Back!
                                </h3>

                                <p class="step-description">
                                    Enter your login details to continue
                                    to your examination account.
                                </p>

                                <div class="form-group">

                                    <label for="identifier" class="form-label">
                                        Email Address or Admission Number
                                    </label>

                                    <div class="input-wrapper">

                                        <span class="input-icon">✉</span>

                                        <input
                                            id="identifier"
                                            type="text"
                                            name="identifier"
                                            class="form-input"
                                            value="{{ old('identifier') }}"
                                            placeholder="Enter email or admission number"
                                            autocomplete="username"
                                            spellcheck="false"
                                            required
                                            autofocus
                                        >

                                    </div>

                                </div>

                                <p class="step-description">
                                    Students should enter their admission number.
                                    Administrators and examiners should enter
                                    their registered email address.
                                </p>

                                <button
                                    type="button"
                                    class="action-button"
                                    id="continueButton"
                                >
                                    Continue
                                    <span class="button-arrow">→</span>
                                </button>

                            </div>

                            <!-- STEP 2: PASSWORD -->

                            <div class="form-face password-face">

                                <h3 class="step-heading">
                                    Almost There!
                                </h3>

                                <p class="step-description">
                                    Enter your password to securely access
                                    your CBT examination dashboard.
                                </p>

                                <div class="form-group">

                                    <label for="password" class="form-label">
                                        Password
                                    </label>

                                    <div class="input-wrapper">

                                        <span class="input-icon">🔒</span>

                                        <input
                                            id="password"
                                            type="password"
                                            name="password"
                                            class="form-input"
                                            placeholder="Enter your password"
                                            autocomplete="current-password"
                                            required
                                            disabled
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            id="togglePassword"
                                            aria-label="Show password"
                                        >
                                            SHOW
                                        </button>

                                    </div>

                                </div>

                                <button
                                    type="submit"
                                    class="action-button"
                                >
                                    Sign In to CBT Portal
                                    <span class="button-arrow">→</span>
                                </button>

                                <button
                                    type="button"
                                    class="back-button"
                                    id="backButton"
                                >
                                    ← Go Back and Edit Login ID
                                </button>

                            </div>

                        </div>

                    </div>

                </form>

                <div class="security-note">

                    <span class="security-icon">●</span>
                    Secure access for authorised students,
                    examiners and administrators only.

                </div>

                <a href="{{ route('home') }}" class="website-link">
                    ← Return to Academy Website
                </a>

            </section>

            <p class="copyright">
                © {{ date('Y') }} Abu Haneefah Islamic Academy.
                All Rights Reserved.
            </p>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const flipInner = document.getElementById('flipInner');
            const identifierInput = document.getElementById('identifier');
            const passwordInput = document.getElementById('password');

            const continueButton = document.getElementById('continueButton');
            const backButton = document.getElementById('backButton');
            const togglePassword = document.getElementById('togglePassword');

            const progressFill = document.getElementById('progressFill');
            const emailLabel = document.getElementById('emailLabel');
            const passwordLabel = document.getElementById('passwordLabel');

            const emailFace = document.querySelector('.email-face');
            const passwordFace = document.querySelector('.password-face');

            function showPasswordStep() {

                flipInner.classList.add('flipped');

                progressFill.classList.add('complete');

                emailLabel.classList.remove('active');
                passwordLabel.classList.add('active');

                emailFace.inert = true;
                passwordFace.inert = false;

                passwordInput.disabled = false;

                setTimeout(() => {
                    passwordInput.focus();
                }, 350);
            }

            function showEmailStep() {

                flipInner.classList.remove('flipped');

                progressFill.classList.remove('complete');

                passwordLabel.classList.remove('active');
                emailLabel.classList.add('active');

                passwordFace.inert = true;
                emailFace.inert = false;

                passwordInput.disabled = true;

                setTimeout(() => {
                    identifierInput.focus();
                }, 350);
            }

            continueButton.addEventListener('click', function () {

                if (!identifierInput.value.trim()) {
                    identifierInput.focus();
                    identifierInput.reportValidity();
                    return;
                }

                if (!identifierInput.checkValidity()) {
                    identifierInput.reportValidity();
                    return;
                }

                showPasswordStep();

            });

            backButton.addEventListener('click', showEmailStep);

            togglePassword.addEventListener('click', function () {

                if (passwordInput.type === 'password') {

                    passwordInput.type = 'text';
                    togglePassword.textContent = 'HIDE';
                    togglePassword.setAttribute('aria-label', 'Hide password');

                } else {

                    passwordInput.type = 'password';
                    togglePassword.textContent = 'SHOW';
                    togglePassword.setAttribute('aria-label', 'Show password');

                }

            });

            // Restore the password screen after a failed login.

            if (flipInner.dataset.initialStep === 'password') {
                showPasswordStep();
            } else {
                emailFace.inert = false;
                passwordFace.inert = true;
                passwordInput.disabled = true;
                emailLabel.classList.add('active');
            }

        });
    </script>

</body>
</html>
