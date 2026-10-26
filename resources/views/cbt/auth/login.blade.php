
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CBT Portal Login | Abu Haneefah Islamic Academy</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f3f6f8;
            color: #173b4d;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 18px;
            padding: 36px;
            box-shadow: 0 12px 40px rgba(23, 59, 77, 0.10);
        }

        .academy-logo {
            width: 82px;
            height: 82px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #d6a84f;
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-input {
            box-sizing: border-box;
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d6dee3;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
        }

        .form-input:focus {
            border-color: #315c72;
            box-shadow: 0 0 0 3px rgba(49, 92, 114, 0.12);
        }

        .login-button {
            width: 100%;
            border: none;
            border-radius: 9px;
            padding: 14px;
            background: #173b4d;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .login-button:hover {
            background: #315c72;
        }

        .message {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error-message {
            background: #fff0f0;
            color: #a52626;
        }

        .success-message {
            background: #edf9f0;
            color: #216b37;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 26px 20px;
            }
        }
    </style>
</head>

<body>
    <main class="login-wrapper">
        <section class="login-card">
            <div style="text-align: center; margin-bottom: 28px;">
                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Abu Haneefah Islamic Academy Logo"
                    class="academy-logo"
                >

                <h1 style="margin: 0 0 8px; font-size: 23px;">
                    Abu Haneefah
                </h1>

                <p style="margin: 0; color: #647783; font-size: 14px;">
                    Islamic Academy
                </p>

                <div style="height: 3px; width: 55px; background: #d6a84f; margin: 20px auto;"></div>

                <h2 style="font-size: 21px; margin: 0 0 8px;">
                    CBT Portal
                </h2>

                <p style="font-size: 14px; color: #647783; margin: 0;">
                    Sign in to access your examination account.
                </p>
            </div>

            @if (session('success'))
                <div class="message success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message error-message" role="alert">
                    @foreach ($errors->all() as $error)
                        <p style="margin: 0 0 5px;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('cbt.login.submit') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="email" class="form-label">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="Enter your registered email"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Sign In to CBT Portal
                </button>
            </form>

            <p style="text-align: center; margin: 24px 0 0; font-size: 12px; color: #71818a;">
                Authorised students, examiners and administrators only.
            </p>

            <p style="text-align: center; margin: 14px 0 0; font-size: 13px;">
                <a href="{{ route('home') }}" style="color: #315c72; text-decoration: none;">
                    ← Return to Academy Website
                </a>
            </p>
        </section>
    </main>
</body>
</html>
