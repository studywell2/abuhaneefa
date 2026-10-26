
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examiner Dashboard | Abuhaneefah Islamic Academy</title>

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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            flex-shrink: 0;
            background: var(--navy);
            color: white;
            padding: 25px 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 25px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: white;
            border-radius: 9px;
            padding: 3px;
        }

        .brand h2 {
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        .brand small {
            display: block;
            color: var(--gold);
            margin-top: 3px;
        }

        .nav-label {
            margin: 28px 10px 12px;
            color: #B7C9D2;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-link {
            display: block;
            padding: 12px;
            margin: 4px 0;
            color: #EAF1F4;
            text-decoration: none;
            font-size: 14px;
            border-radius: 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--blue);
        }

        .nav-link.active {
            border-left: 3px solid var(--gold);
        }

        .logout {
            width: 100%;
            margin-top: 30px;
            padding: 11px;
            background: transparent;
            color: white;
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 8px;
            cursor: pointer;
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 22px 30px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .topbar h1 {
            font-size: 23px;
            margin: 0;
        }

        .topbar p {
            color: var(--muted);
            font-size: 13px;
            margin: 7px 0 0;
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
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #E5EEF2;
            color: var(--navy);
        }

        .content {
            padding: 30px;
        }

        .welcome {
            padding: 28px;
            border-radius: 14px;
            color: white;
            background: linear-gradient(115deg, var(--navy), var(--blue));
            margin-bottom: 28px;
        }

        .welcome .tag {
            display: inline-block;
            background: rgba(214,168,79,.18);
            color: #FFE1A0;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .welcome h2 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .welcome p {
            max-width: 650px;
            color: #E0EAF0;
            font-size: 14px;
            line-height: 1.8;
            margin: 0;
        }

        .section-heading {
            margin: 28px 0 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 18px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 13px;
            margin: 6px 0 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 21px;
        }

        .card .icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            background: #EAF1F4;
            border-radius: 10px;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin: 0;
            font-size: 24px;
        }

        .card p {
            margin: 8px 0 0;
            font-size: 13px;
            color: var(--muted);
        }

        .placeholder {
            margin-top: 12px;
            color: var(--muted);
            font-size: 11px;
        }

        .task-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .task {
            display: block;
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 23px;
            text-decoration: none;
            color: var(--text);
        }

        .task:hover {
            border-color: var(--gold);
        }

        .task .icon {
            font-size: 25px;
            margin-bottom: 15px;
        }

        .task h3 {
            font-size: 15px;
            margin: 0 0 9px;
        }

        .task p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .status {
            display: inline-block;
            margin-top: 14px;
            background: #FFF4D9;
            color: #785512;
            border-radius: 20px;
            padding: 6px 10px;
            font-size: 11px;
        }

        .notice {
            background: white;
            border: 1px solid var(--border);
            border-left: 4px solid var(--gold);
            padding: 18px;
            border-radius: 10px;
            margin-top: 24px;
            font-size: 13px;
            line-height: 1.7;
        }

        .footer {
            border-top: 1px solid var(--border);
            margin-top: 30px;
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .app {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .nav-label {
                width: 100%;
            }

            .topbar {
                padding: 18px;
            }

            .topbar h1 {
                font-size: 19px;
            }

            .user span {
                display: none;
            }

            .content {
                padding: 18px;
            }

            .cards,
            .task-grid {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 22px;
            }

            .footer {
                padding: 18px;
            }
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
                <small>EXAMINER PORTAL</small>
            </h2>
        </div>

        <nav>
            <div class="nav-label">Workspace</div>
            <a href="{{ route('cbt.examiner.dashboard') }}" class="nav-link active">
                ◈ &nbsp; Overview
            </a>
            <a href="#examinations" class="nav-link">▤ &nbsp; My Examinations</a>
            <a href="#questions" class="nav-link">✎ &nbsp; Question Bank</a>
            <a href="#submissions" class="nav-link">▥ &nbsp; Submissions</a>
            <a href="#results" class="nav-link">✓ &nbsp; Results Review</a>
        </nav>

        <form method="POST" action="{{ route('cbt.logout') }}">
            @csrf
            <button type="submit" class="logout">↪ &nbsp; Sign Out</button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Examiner Workspace</h1>
                <p>Prepare and review examinations assigned to you.</p>
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
                <span class="tag">EXAMINER ACCESS</span>
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p>
                    Use this workspace to manage assigned examination
                    activities, prepare questions and review student results.
                    Results will require administrator approval before release.
                </p>
            </section>

            <div class="section-heading">
                <h2>Your Overview</h2>
                <p>Live examination data will appear here when the modules are connected.</p>
            </div>

            <section class="cards">
                <div class="card" id="examinations">
                    <div class="icon">📝</div>
                    <h3>—</h3>
                    <p>Assigned Examinations</p>
                    <div class="placeholder">Examination assignments not connected yet</div>
                </div>

                <div class="card" id="questions">
                    <div class="icon">✎</div>
                    <h3>—</h3>
                    <p>Questions Prepared</p>
                    <div class="placeholder">Question bank not connected yet</div>
                </div>

                <div class="card" id="submissions">
                    <div class="icon">▥</div>
                    <h3>—</h3>
                    <p>Submissions to Review</p>
                    <div class="placeholder">Submission data not connected yet</div>
                </div>
            </section>

            <div class="section-heading">
                <h2>Examination Tools</h2>
                <p>Tools for your assigned examination responsibilities.</p>
            </div>

            <section class="task-grid">
                <a href="#examinations" class="task">
                    <div class="icon">📚</div>
                    <h3>My Examinations</h3>
                    <p>View assigned subjects, examination schedules and exam instructions.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#questions" class="task">
                    <div class="icon">🗂️</div>
                    <h3>Question Bank</h3>
                    <p>Prepare questions, multiple-choice options and correct answers for assigned exams.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#submissions" class="task">
                    <div class="icon">📋</div>
                    <h3>Student Submissions</h3>
                    <p>Review completed examination attempts and check submission records.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#results" class="task" id="results">
                    <div class="icon">📊</div>
                    <h3>Results Review</h3>
                    <p>Review scores and submit results for administrator approval before publication.</p>
                    <span class="status">Planned module</span>
                </a>
            </section>

            <div class="notice">
                <strong>Result release policy:</strong>
                Examiners can prepare and review results, but students must not
                see results until an authorised administrator approves them.
            </div>

            <footer class="footer">
                © {{ date('Y') }} Abuhaneefah Islamic Academy.
                CBT Examiner Portal.
            </footer>
        </div>
    </main>

</div>
</body>
</html>
