
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Examiner | Abu Haneefah Islamic Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
            --text: #243746;
            --muted: #718096;
            --border: #e3eaee;
            --red: #bd4141;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 5% 10%, rgba(49,92,114,.10), transparent 28%),
                radial-gradient(circle at 95% 90%, rgba(214,168,79,.10), transparent 28%),
                var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        a { text-decoration: none; }

        .topbar {
            min-height: 82px;
            background: var(--navy);
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand { display: flex; align-items: center; gap: 13px; }

        .brand img {
            width: 49px;
            height: 49px;
            object-fit: contain;
            background: white;
            border-radius: 9px;
            padding: 3px;
        }

        .brand h1 { font-size: 18px; margin: 0 0 5px; }
        .brand p { font-size: 12px; margin: 0; color: var(--gold); }
        .back-link { color: #f2dcae; font-size: 13px; font-weight: bold; }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 22px;
        }

        .heading { margin-bottom: 24px; }
        .heading h2 { color: var(--navy); font-size: 27px; margin: 0 0 8px; }
        .heading p { color: var(--muted); font-size: 14px; line-height: 1.6; margin: 0; }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(23,59,77,.05);
        }

        .panel h3 { color: var(--navy); margin: 0 0 8px; font-size: 19px; }
        .panel-description { color: var(--muted); font-size: 13px; line-height: 1.6; margin: 0 0 25px; }

        .form-group { margin-bottom: 21px; }

        label {
            display: block;
            color: var(--navy);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .required { color: var(--red); }

        input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #d6e0e5;
            border-radius: 8px;
            background: #fbfcfd;
            color: var(--text);
            font-size: 14px;
            transition: .2s;
        }

        input:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(49,92,114,.10);
        }

        .field-help { color: var(--muted); font-size: 12px; margin-top: 8px; line-height: 1.5; }

        .error-list {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #9f1239;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.7;
        }

        .info-box {
            background: #f1f6f8;
            border-left: 4px solid var(--blue);
            padding: 15px 17px;
            border-radius: 7px;
            margin: 24px 0;
            color: #526875;
            font-size: 13px;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 27px;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 13px 19px;
            border: none;
            border-radius: 8px;
            background: var(--blue);
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        .btn:hover { background: var(--navy); transform: translateY(-2px); }
        .btn-gold { background: var(--gold); color: var(--navy); }
        .btn-gold:hover { background: #c69a3e; color: var(--navy); }
        .btn-light { background: #e9f0f3; color: var(--navy); }
        .btn-light:hover { background: #dce8ed; color: var(--navy); }

        .footer {
            text-align: center;
            color: #89959d;
            font-size: 12px;
            padding: 15px 0 30px;
        }

        @media (max-width: 600px) {
            .topbar { padding: 15px 18px; }
            .brand h1 { font-size: 15px; }
            .brand img { width: 43px; height: 43px; }
            .container { margin: 25px auto; padding: 0 13px; }
            .panel { padding: 21px 17px; }
            .heading h2 { font-size: 23px; }
            .actions { flex-direction: column; }
            .actions .btn { width: 100%; }
        }
    </style>
</head>

<body>
<header class="topbar">
    <div class="brand">
        <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">
        <div>
            <h1>Abu Haneefah Islamic Academy</h1>
            <p>CBT Portal · Administration</p>
        </div>
    </div>

    <a class="back-link" href="{{ route('cbt.admin.examiners.index') }}">
        &larr; Back to Examiners
    </a>
</header>

<main class="container">
    <div class="heading">
        <h2>Register New Examiner</h2>
        <p>Create an examiner account for the academy's Computer-Based Testing portal.</p>
    </div>

    <section class="panel">
        <h3>Examiner Information</h3>
        <p class="panel-description">
            Enter the examiner's correct details. The system will automatically generate a temporary login password.
        </p>

        @if ($errors->any())
            <div class="error-list" role="alert">
                <strong>Please correct the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cbt.admin.examiners.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter examiner's full name"
                    maxlength="255"
                    required
                    autocomplete="name"
                >
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="examiner@example.com"
                    maxlength="255"
                    required
                    autocomplete="email"
                >
                <p class="field-help">
                    This email address will be used by the examiner to log in to the CBT portal.
                </p>
            </div>

            <div class="info-box">
                <strong>Account Security</strong><br>
                A temporary password will be generated automatically after registration.
                Make sure to provide the login credentials privately to the examiner.
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-gold">
                    Register Examiner
                </button>

                <a href="{{ route('cbt.admin.examiners.index') }}" class="btn btn-light">
                    Cancel
                </a>
            </div>
        </form>
    </section>

    <footer class="footer">
        Abu Haneefah Islamic Academy &copy; {{ date('Y') }}
        <br>
        CBT Administration Portal
    </footer>
</main>
</body>
</html>
