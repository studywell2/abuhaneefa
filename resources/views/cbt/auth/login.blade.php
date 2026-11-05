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
            --light: #f4f6f5;
            --muted: #75838a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--navy);
            background: #f4f6f5;
            overflow-x: hidden;
        }

        .background-shape {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }

        .shape-one {
            width: 340px;
            height: 340px;
            top: -175px;
            left: -150px;
            background: rgba(214,168,79,.13);
            filter: blur(2px);
        }

        .shape-two {
            width: 420px;
            height: 420px;
            right: -230px;
            bottom: -235px;
            background: rgba(49,92,114,.09);
            filter: blur(2px);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            position: relative;
            z-index: 1;
        }

        .login-container {
            width: 100%;
            max-width: 1040px;
            animation: entrance .65s ease both;
        }

        @keyframes entrance {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(0, 1fr);
            min-height: 620px;
            background: #fff;
            border: 1px solid rgba(23,59,77,.07);
            border-radius: 25px;
            box-shadow: 0 28px 80px rgba(23,59,77,.12);
            overflow: hidden;
        }

        .welcome-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100%;
            padding: 48px 44px 38px;
            overflow: hidden;
            color: #fff;
            background:
                radial-gradient(ellipse at 15% 100%, rgba(214,168,79,.2), transparent 42%),
                linear-gradient(150deg, #173b4d 0%, #204d5c 62%, #315c72 100%);
        }

        .welcome-panel::before,
        .welcome-panel::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .welcome-panel::before {
            width: 420px;
            height: 420px;
            right: -260px;
            top: -150px;
        }

        .welcome-panel::after {
            width: 310px;
            height: 310px;
            right: -205px;
            top: -95px;
        }

        .welcome-mark {
            position: relative;
            z-index: 1;
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 15px;
            color: #f0cb7c;
            font-size: 23px;
        }

        .welcome-copy {
            position: relative;
            z-index: 1;
            margin: auto 0;
            padding: 54px 0;
        }

        .welcome-eyebrow {
            margin: 0 0 17px;
            color: #edca80;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .welcome-title {
            max-width: 390px;
            margin: 0;
            font-size: clamp(32px, 4vw, 43px);
            font-weight: 700;
            letter-spacing: -1.6px;
            line-height: 1.16;
        }

        .welcome-description {
            max-width: 345px;
            margin: 19px 0 0;
            color: rgba(255,255,255,.72);
            font-size: 14px;
            line-height: 1.8;
        }

        .welcome-footer {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 11px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.17);
            color: rgba(255,255,255,.75);
            font-size: 12px;
        }

        .welcome-footer-mark {
            color: #edca80;
            font-size: 16px;
        }

        .login-content {
            width: 100%;
            max-width: 530px;
            align-self: center;
            justify-self: center;
            padding: 44px 52px;
        }

        .academy-header {
            margin-bottom: 30px;
        }

        .academy-brand {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 29px;
        }

        .logo-wrapper {
            flex: 0 0 auto;
            width: 54px;
            height: 54px;
            padding: 3px;
            border: 1px solid rgba(214,168,79,.75);
            border-radius: 16px;
            background: #fffdf8;
            box-shadow: 0 5px 15px rgba(23,59,77,.08);
            transition: box-shadow .3s, transform .3s;
        }

        .logo-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(23,59,77,.13);
        }

        .academy-logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .academy-name {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -.2px;
        }

        .academy-subtitle {
            margin: 3px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .gold-line {
            display: none;
        }

        .portal-title {
            margin: 0 0 7px;
            font-size: 24px;
            font-weight: 750;
            letter-spacing: -.55px;
        }

        .portal-description {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .progress-section {
            margin: 0 0 27px;
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #a0abb1;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .progress-labels span.active {
            color: var(--blue);
        }

        .progress-track {
            height: 4px;
            border-radius: 10px;
            background: #e9eef0;
            overflow: hidden;
        }

        .progress-fill {
            width: 50%;
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            transition: width .6s cubic-bezier(.22,1,.36,1);
        }

        .progress-fill.complete {
            width: 100%;
        }

        .flip-container {
            width: 100%;
            perspective: 1200px;
        }

        .flip-inner {
            position: relative;
            width: 100%;
            transform-style: preserve-3d;
            transition: transform .75s cubic-bezier(.2,.75,.25,1);
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
            margin: 0 0 7px;
            font-size: 19px;
            font-weight: 750;
            letter-spacing: -.3px;
        }

        .step-description {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.65;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #82949d;
            font-size: 16px;
            pointer-events: none;
            transition: color .3s;
        }

        .form-input {
            width: 100%;
            padding: 14px 45px;
            border: 1px solid #dfe6e8;
            border-radius: 10px;
            outline: none;
            background: #fbfcfc;
            color: var(--navy);
            font: inherit;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-input:hover {
            border-color: #a7bac4;
            background: #fff;
        }

        .form-input:focus {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(49,92,114,.1);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--gold);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            padding: 7px;
            border: 0;
            background: transparent;
            color: #71818a;
            cursor: pointer;
            font-size: 11px;
            font-weight: 750;
        }

        .password-toggle:hover {
            color: var(--blue);
        }

        .action-button {
            position: relative;
            width: 100%;
            padding: 14px;
            overflow: hidden;
            border: 0;
            border-radius: 10px;
            background: var(--navy);
            color: #fff;
            font-size: 13px;
            font-weight: 750;
            cursor: pointer;
            transition: background .2s, box-shadow .2s, transform .2s;
        }

        .action-button:hover {
            transform: translateY(-1px);
            background: var(--blue);
            box-shadow: 0 8px 18px rgba(23,59,77,.18);
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
            transform: translateX(4px);
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 14px 10px 0;
            border: 0;
            background: transparent;
            color: var(--blue);
            font-size: 12px;
            font-weight: 650;
            cursor: pointer;
            transition: color .3s;
        }

        .back-button:hover {
            color: #a77821;
        }

        .message {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.6;
            animation: entrance .4s ease;
        }

        .error-message {
            border-left: 4px solid #d9534f;
            background: #fff0f0;
            color: #a52626;
        }

        .success-message {
            border-left: 4px solid #39a85a;
            background: #edf9f0;
            color: #216b37;
        }

        .security-note {
            margin: 25px 0 0;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
            text-align: center;
        }

        .security-icon {
            margin-right: 5px;
            color: #3b9461;
        }

        .website-link {
            display: block;
            margin-top: 14px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 650;
            text-align: center;
            text-decoration: none;
            transition: color .2s;
        }

        .website-link:hover {
            color: #a77821;
        }

        .copyright {
            margin: 18px 0 0;
            color: #9aa7ad;
            font-size: 11px;
            text-align: center;
        }

        @media(max-width: 760px) {
            .login-wrapper {
                padding: 30px 18px;
            }

            .login-container {
                max-width: 560px;
            }

            .login-card {
                grid-template-columns: 1fr;
                min-height: 0;
            }

            .welcome-panel {
                min-height: 220px;
                padding: 25px 30px;
            }

            .welcome-mark {
                width: 40px;
                height: 40px;
                border-radius: 12px;
            }

            .welcome-copy {
                margin: 22px 0 0;
                padding: 0 0 14px;
            }

            .welcome-eyebrow {
                margin-bottom: 8px;
                font-size: 10px;
            }

            .welcome-title {
                max-width: 460px;
                font-size: 29px;
            }

            .welcome-description,
            .welcome-footer {
                display: none;
            }

            .login-content {
                max-width: none;
                padding: 34px 36px 36px;
            }
        }

        @media(max-width: 420px) {
            .login-wrapper {
                padding: 18px 12px;
            }

            .login-card {
                border-radius: 19px;
            }

            .welcome-panel {
                min-height: 190px;
                padding: 20px 22px;
            }

            .welcome-title {
                font-size: 26px;
            }

            .login-content {
                padding: 28px 22px;
            }

            .portal-title {
                font-size: 22px;
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

                <aside class="welcome-panel" aria-label="Examination portal introduction">
                    <div class="welcome-mark" aria-hidden="true">✦</div>

                    <div class="welcome-copy">
                        <p class="welcome-eyebrow">Learn. Prepare. Excel.</p>
                        <h2 class="welcome-title">Your next achievement starts here.</h2>
                        <p class="welcome-description">
                            A focused, secure space for Abu Haneefah students and staff
                            to access online examinations.
                        </p>
                    </div>

                    <div class="welcome-footer">
                        <span class="welcome-footer-mark" aria-hidden="true">✧</span>
                        <span>Knowledge with purpose</span>
                    </div>
                </aside>

                <div class="login-content">

                <header class="academy-header">

                    <div class="academy-brand">
                        <div class="logo-wrapper">
                            <img
                                src="{{ asset('images/logo.jpg') }}"
                                alt="Abu Haneefah Islamic Academy Logo"
                                class="academy-logo"
                            >
                        </div>

                        <div>
                            <h1 class="academy-name">Abu Haneefah</h1>

                            <p class="academy-subtitle">
                                Islamic Academy
                            </p>
                        </div>
                    </div>

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

                </div>

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
