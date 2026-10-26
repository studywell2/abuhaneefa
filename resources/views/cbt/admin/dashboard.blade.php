<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard | Abuhaneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
            --white: #FFFFFF;
            --text: #243746;
            --muted: #718096;
            --border: #E2E8F0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 255px;
            background: var(--navy);
            color: white;
            padding: 25px 16px;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 26px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
            padding: 3px;
        }

        .brand h2 {
            font-size: 15px;
            line-height: 1.4;
            margin: 0;
        }

        .brand small {
            display: block;
            color: #D6A84F;
            margin-top: 4px;
        }

        .nav-label {
            color: #B7C9D2;
            font-size: 11px;
            letter-spacing: 1.2px;
            margin: 28px 10px 12px;
            text-transform: uppercase;
        }

        .nav-link {
            display: block;
            padding: 12px;
            margin: 4px 0;
            color: #EAF1F4;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--blue);
            color: white;
        }

        .nav-link.active {
            border-left: 3px solid var(--gold);
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            min-height: 82px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 30px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 23px;
        }

        .topbar p {
            color: var(--muted);
            margin: 6px 0 0;
            font-size: 13px;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: bold;
        }

        .avatar {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #E5EEF2;
            color: var(--navy);
            font-size: 16px;
        }

        .content { padding: 30px; }

        .welcome {
            background: linear-gradient(115deg, var(--navy), var(--blue));
            color: white;
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .welcome h2 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .welcome p {
            margin: 0;
            color: #E0EAF0;
            line-height: 1.7;
            max-width: 650px;
        }

        .welcome .tag {
            display: inline-block;
            background: rgba(214,168,79,.18);
            color: #FFE1A0;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            margin-bottom: 16px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 28px 0 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 18px;
        }

        .section-heading p {
            color: var(--muted);
            margin: 5px 0 0;
            font-size: 13px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            min-width: 0;
        }

        .card .icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: #EAF1F4;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .card h3 {
            margin: 0;
            font-size: 25px;
        }

        .card p {
            color: var(--muted);
            margin: 8px 0 0;
            font-size: 13px;
        }

        .placeholder {
            color: var(--muted);
            font-size: 11px;
            margin-top: 12px;
        }

        .management-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .management-card {
            display: block;
            text-decoration: none;
            color: var(--text);
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 21px;
            transition: border-color .2s, transform .2s;
        }

        .management-card:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        .management-card .icon {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .management-card h3 {
            font-size: 15px;
            margin: 0 0 8px;
        }

        .management-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .status {
            display: inline-block;
            font-size: 11px;
            background: #FFF4D9;
            color: #785512;
            border-radius: 20px;
            padding: 6px 9px;
            margin-top: 14px;
        }

        .footer {
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
            border-top: 1px solid var(--border);
            margin-top: 30px;
        }

        .logout {
            background: transparent;
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            width: 100%;
            padding: 11px;
            margin-top: 30px;
            font-size: 13px;
        }

        .logout:hover { background: rgba(255,255,255,.1); }

        @media (max-width: 1100px) {
            .cards { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .management-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 700px) {
            .app { display: block; }
            .sidebar { width: 100%; padding: 18px; }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .nav-label {
                width: 100%;
                margin-top: 18px;
            }

            .nav-link { margin: 0; }

            .topbar {
                padding: 18px;
                align-items: flex-start;
            }

            .topbar h1 { font-size: 19px; }
            .user span { display: none; }
            .content { padding: 18px; }
            .welcome { padding: 22px; }
            .welcome h2 { font-size: 21px; }

            .cards,
            .management-grid {
                grid-template-columns: 1fr;
            }

            .footer { padding: 18px; }
        }
    </style>
</head>
<body>
<div class="app">

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">
            <h2>
                Abuhaneefah Islamic Academy
                <small>CBT MANAGEMENT</small>
            </h2>
        </div>

        <nav>
            <div class="nav-label">Main Menu</div>

            <a href="{{ route('cbt.admin.dashboard') }}" class="nav-link active">
                ◈ &nbsp; Overview
            </a>

            <div class="nav-label">Academic Management</div>

            <a href="{{ route('cbt.admin.students.index') }}" class="nav-link">
                ♙ &nbsp; Students
            </a>

            <a href="#examiners" class="nav-link">♧ &nbsp; Examiners</a>
            <a href="#exams" class="nav-link">▤ &nbsp; Examinations</a>
            <a href="#results" class="nav-link">▥ &nbsp; Results</a>

            <div class="nav-label">Administration</div>

            <a href="#pins" class="nav-link">◇ &nbsp; Result PINs</a>
            <a href="#settings" class="nav-link">⚙ &nbsp; Settings</a>
        </nav>

        <form method="POST" action="{{ route('cbt.logout') }}">
            @csrf
            <button type="submit" class="logout">↪ &nbsp; Sign Out</button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Administrator Dashboard</h1>
                <p>Manage your academy's computer-based examination portal.</p>
            </div>

            <div class="user">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </header>

        <div class="content">
            <section class="welcome">
                <span class="tag">ADMINISTRATOR ACCESS</span>
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p>
                    This is your central workspace for managing students,
                    examiners, examinations, approved results and result PINs.
                    Your examination management tools will be connected in the
                    next development stages.
                </p>
            </section>

            <div class="section-heading">
                <div>
                    <h2>Portal Overview</h2>
                    <p>Summary cards will display live database figures as we build each module.</p>
                </div>
            </div>

            <section class="cards">
                <div class="card" id="students">
                    <div class="icon">♙</div>
                    <h3>—</h3>
                    <p>Registered Students</p>
                    <div class="placeholder">Student module not connected yet</div>
                </div>

                <div class="card" id="examiners">
                    <div class="icon">♧</div>
                    <h3>—</h3>
                    <p>Registered Examiners</p>
                    <div class="placeholder">Examiner module not connected yet</div>
                </div>

                <div class="card" id="exams">
                    <div class="icon">▤</div>
                    <h3>—</h3>
                    <p>Examinations</p>
                    <div class="placeholder">Examination module not connected yet</div>
                </div>

                <div class="card" id="results">
                    <div class="icon">▥</div>
                    <h3>—</h3>
                    <p>Results Awaiting Approval</p>
                    <div class="placeholder">Results module not connected yet</div>
                </div>
            </section>

            <div class="section-heading">
                <div>
                    <h2>Management Centre</h2>
                    <p>Access the main administration areas.</p>
                </div>
            </div>

            <section class="management-grid">
                <a href="{{ route('cbt.admin.students.index') }}" class="management-card">
                    <div class="icon">👨‍🎓</div>
                    <h3>Student Management</h3>
                    <p>Register centre students, maintain their profiles and assign unique student numbers.</p>
                    <span class="status">Open Student Management</span>
                </a>

                <a href="#examiners" class="management-card">
                    <div class="icon">👨‍🏫</div>
                    <h3>Examiner Management</h3>
                    <p>Create examiner accounts and control access to examination and marking tasks.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#exams" class="management-card">
                    <div class="icon">📝</div>
                    <h3>Examination Management</h3>
                    <p>Organise subjects, questions, answer options, duration and examination schedules.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#results" class="management-card">
                    <div class="icon">📊</div>
                    <h3>Results &amp; Approval</h3>
                    <p>Review submitted examination results and approve them before students can view them.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#pins" class="management-card">
                    <div class="icon">🔐</div>
                    <h3>Result PIN Management</h3>
                    <p>Record payments, issue secure result PINs and manage their validity across two consecutive terms.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#settings" class="management-card">
                    <div class="icon">⚙️</div>
                    <h3>Portal Settings</h3>
                    <p>Configure academic sessions, terms and other examination portal settings.</p>
                    <span class="status">Planned module</span>
                </a>
            </section>

            <footer class="footer">
                © {{ date('Y') }} Abuhaneefah Islamic Academy.
                CBT Management Portal.
            </footer>
        </div>
    </main>

</div>
</body>
</html>
