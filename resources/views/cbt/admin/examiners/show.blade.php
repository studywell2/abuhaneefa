
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examiner Details | Abu Haneefah Islamic Academy</title>
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
            max-width: 950px;
            margin: 40px auto;
            padding: 0 22px;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .heading h2 { color: var(--navy); font-size: 27px; margin: 0 0 8px; }
        .heading p { color: var(--muted); font-size: 14px; margin: 0; line-height: 1.6; }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 12px 17px;
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

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 5px 20px rgba(23,59,77,.05);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 23px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 23px;
        }

        .avatar {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            background: #e8f0f4;
            color: var(--navy);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .profile-header h3 { color: var(--navy); font-size: 20px; margin: 0 0 7px; }
        .profile-header p { color: var(--muted); font-size: 13px; margin: 0; overflow-wrap: anywhere; }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #e5f6ed;
            color: #16734e;
            font-size: 11px;
            font-weight: bold;
        }

        .status::before {
            content: "";
            width: 6px;
            height: 6px;
            background: currentColor;
            border-radius: 50%;
        }

        .status-inactive { background: #fff0ef; color: #b33e3e; }

        .section-title {
            color: var(--navy);
            font-size: 16px;
            margin: 0 0 18px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .detail-item {
            padding: 15px;
            background: #f8fafb;
            border: 1px solid #edf1f3;
            border-radius: 9px;
        }

        .detail-item label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 9px;
        }

        .detail-item p {
            margin: 0;
            color: var(--navy);
            font-size: 14px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

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
            .panel { padding: 20px 16px; }
            .heading h2 { font-size: 23px; }
            .details-grid { grid-template-columns: 1fr; gap: 12px; }
            .actions .btn { flex: 1 1 100%; }
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
        <div>
            <h2>Examiner Details</h2>
            <p>Review the examiner's account information and registration record.</p>
        </div>

        <a href="{{ route('cbt.admin.examiners.edit', $examiner) }}" class="btn btn-gold">
            Edit Examiner
        </a>
    </div>

    <section class="panel">
        <div class="profile-header">
            <div class="avatar">
                {{ strtoupper(substr($examiner->name, 0, 1)) }}
            </div>

            <div>
                <h3>{{ $examiner->name }}</h3>
                <p>{{ $examiner->email }}</p>
                <div style="margin-top: 10px;">
                    @if ($examiner->is_active)
                        <span class="status">Active Account</span>
                    @else
                        <span class="status status-inactive">Inactive Account</span>
                    @endif
                </div>
            </div>
        </div>

        <h3 class="section-title">Account Information</h3>

        <div class="details-grid">
            <div class="detail-item">
                <label>Full Name</label>
                <p>{{ $examiner->name }}</p>
            </div>

            <div class="detail-item">
                <label>Email Address</label>
                <p>{{ $examiner->email }}</p>
            </div>

            <div class="detail-item">
                <label>Account Role</label>
                <p>Examiner</p>
            </div>

            <div class="detail-item">
                <label>Account Status</label>
                <p>{{ $examiner->is_active ? 'Active' : 'Inactive' }}</p>
            </div>

            <div class="detail-item">
                <label>Registration Date</label>
                <p>{{ $examiner->created_at?->format('d F Y, h:i A') }}</p>
            </div>

            <div class="detail-item">
                <label>Last Updated</label>
                <p>{{ $examiner->updated_at?->format('d F Y, h:i A') }}</p>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('cbt.admin.examiners.index') }}" class="btn btn-light">
                Back to Examiner List
            </a>

            <a href="{{ route('cbt.admin.examiners.edit', $examiner) }}" class="btn btn-gold">
                Edit Account
            </a>
        </div>
    </section>

    <footer class="footer">
        Abu Haneefah Islamic Academy &copy; {{ date('Y') }}
        <br>
        CBT Administration Portal
    </footer>
</main>
</body>
</html>
