
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result PIN | Abu Haneefah Islamic Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --background: #F3F7F8;
            --gold: #D6A84F;
            --white: #ffffff;
            --muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: #243746;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: var(--navy);
            color: white;
            padding: 25px 18px;
        }

        .brand {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid #ffffff25;
        }

        .brand img {
            width: 75px;
            height: 75px;
            object-fit: contain;
            background: white;
            border-radius: 12px;
            padding: 5px;
        }

        .brand h2 {
            font-size: 17px;
            margin: 12px 0 5px;
        }

        .brand p {
            font-size: 12px;
            color: #dbe7ec;
            margin: 0;
        }

        .nav-title {
            color: #b8cbd4;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 28px 10px 12px;
        }

        .nav-item {
            display: block;
            color: #edf4f6;
            text-decoration: none;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .nav-item.active,
        .nav-item:hover {
            background: var(--blue);
        }

        .nav-item.active {
            border-left: 4px solid var(--gold);
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .topbar h1 {
            color: var(--navy);
            font-size: 23px;
            margin: 0 0 5px;
        }

        .topbar p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        .logout {
            background: var(--navy);
            color: white;
            border: 0;
            border-radius: 7px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 13px;
        }

        .content {
            padding: 30px;
            max-width: 1100px;
            margin: auto;
        }

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h2 {
            color: var(--navy);
            margin: 0 0 8px;
            font-size: 22px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .pin-card {
            max-width: 650px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px #173b4d08;
        }

        .pin-icon {
            width: 55px;
            height: 55px;
            display: grid;
            place-items: center;
            background: #eaf1f4;
            border-radius: 12px;
            font-size: 27px;
            margin-bottom: 18px;
        }

        .pin-card h3 {
            color: var(--navy);
            font-size: 19px;
            margin: 0 0 10px;
        }

        .pin-card .description {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: var(--navy);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .pin-input {
            width: 100%;
            padding: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 20px;
            letter-spacing: 5px;
            text-align: center;
            outline: none;
        }

        .pin-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px #315c7215;
        }

        .help-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
        }

        .submit-button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-button:hover {
            background: var(--blue);
        }

        .alert {
            padding: 13px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-error {
            background: #fff0f0;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .notice {
            max-width: 650px;
            margin-top: 22px;
            background: white;
            border-left: 4px solid var(--gold);
            border-radius: 7px;
            padding: 18px;
        }

        .notice h4 {
            color: var(--navy);
            margin: 0 0 8px;
            font-size: 14px;
        }

        .notice p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        footer {
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 15px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 12px;
                text-align: left;
                padding-bottom: 15px;
            }

            .brand img {
                width: 50px;
                height: 50px;
            }

            .brand h2 {
                margin: 0 0 5px;
            }

            .nav-title {
                margin-top: 16px;
            }

            .topbar {
                padding: 18px;
            }

            .topbar h1 {
                font-size: 19px;
            }

            .content {
                padding: 18px;
            }

            .pin-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Academy Logo">

            <div>
                <h2>Abu Haneefah</h2>
                <p>Islamic Academy CBT Portal</p>
            </div>
        </div>

        <p class="nav-title">Student Portal</p>

        <a href="{{ route('cbt.student.dashboard') }}" class="nav-item">
            My Dashboard
        </a>

        <a href="{{ route('cbt.student.examinations.index') }}" class="nav-item">
            Available Examinations
        </a>

        <a href="{{ route('cbt.student.results.index') }}" class="nav-item">
            My Results
        </a>

        <a href="{{ route('cbt.student.results.pin') }}" class="nav-item active">
            Result PIN
        </a>

        <p class="nav-title">Account</p>

        <form method="POST" action="{{ route('cbt.logout') }}">
            @csrf

            <button type="submit" class="nav-item"
                    style="width:100%;text-align:left;border:0;cursor:pointer;background:transparent;">
                Log Out
            </button>
        </form>

    </aside>


    <main class="main">

        <header class="topbar">

            <div>
                <h1>Result PIN</h1>
                <p>Secure access to your approved examination results.</p>
            </div>

            <form method="POST" action="{{ route('cbt.logout') }}">
                @csrf
                <button type="submit" class="logout">Log Out</button>
            </form>

        </header>


        <div class="content">

            <div class="page-heading">
                <h2>Unlock Your Examination Results</h2>

                <p>
                    Enter the 12-digit Result PIN issued to you by
                    Abu Haneefah Islamic Academy.
                </p>
            </div>


            <section class="pin-card">

                <div class="pin-icon">🔐</div>

                <h3>Enter Your Result PIN</h3>

                <p class="description">
                    Your Result PIN gives you access to your own approved
                    examination results for the two consecutive academic
                    terms covered by the PIN.
                </p>


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                @if ($errors->any())
                    <div class="alert alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif


                <form method="POST" action="{{ route('cbt.student.results.validate-pin') }}">

                    @csrf

                    <label for="pin">12-Digit Result PIN</label>

                    <input
                        type="text"
                        id="pin"
                        name="pin"
                        class="pin-input"
                        placeholder="000000000000"
                        maxlength="12"
                        minlength="12"
                        inputmode="numeric"
                        pattern="[0-9]{12}"
                        autocomplete="off"
                        required
                    >

                    <p class="help-text">
                        Enter all 12 digits without spaces.
                    </p>

                    <button type="submit" class="submit-button">
                        Validate PIN and View Results
                    </button>

                </form>

            </section>


            <section class="notice">

                <h4>Important Information</h4>

                <p>
                    Your Result PIN is personal and must not be shared
                    with another student. It can only unlock your own
                    approved results. A valid PIN does not automatically
                    approve examination results. Results must first be
                    approved by the school administrator.
                </p>

            </section>

        </div>


        <footer>
            Abu Haneefah Islamic Academy · Computer-Based  Portal
        </footer>

    </main>

</div>

</body>
</html>
