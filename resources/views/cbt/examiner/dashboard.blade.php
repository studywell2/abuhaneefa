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

        a {
            text-decoration: none;
        }

        /* TOP NAVIGATION */
        .topnav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 75px;
            background: var(--navy);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 30px;
            z-index: 1000;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 220px;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            background: white;
            border-radius: 8px;
            padding: 3px;
        }

        .brand strong {
            display: block;
            font-size: 13px;
            line-height: 1.5;
        }

        .brand small {
            display: block;
            color: var(--gold);
            font-size: 10px;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-item {
            position: relative;
        }

        .nav-button {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #EAF1F4;
            background: transparent;
            border: 0;
            padding: 13px 14px;
            border-radius: 7px;
            font-size: 13px;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s ease;
        }

        .nav-button:hover,
        .nav-item:hover>.nav-button {
            background: var(--blue);
            color: white;
        }

        .arrow {
            font-size: 10px;
            color: var(--gold);
        }

        .dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 215px;
            padding: 8px;
            background: white;
            border-radius: 9px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .16);
            z-index: 1100;
            animation: dropdownIn .18s ease;
        }

        .nav-item:hover .dropdown,
        .nav-item:focus-within .dropdown {
            display: block;
        }

        .dropdown a {
            display: block;
            padding: 11px 12px;
            color: var(--text);
            font-size: 13px;
            border-radius: 6px;
            transition: background .2s ease, color .2s ease;
        }

        .dropdown a:hover {
            background: #EAF1F4;
            color: var(--navy);
        }

        @keyframes dropdownIn {
            from {
                opacity: 0;
                transform: translateY(7px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 9px;
            padding-left: 15px;
            border-left: 1px solid rgba(255, 255, 255, .2);
        }

        .avatar {
            width: 37px;
            height: 37px;
            display: grid;
            place-items: center;
            background: var(--gold);
            color: var(--navy);
            border-radius: 50%;
            font-weight: bold;
        }

        .profile-name {
            font-size: 12px;
            font-weight: bold;
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .logout {
            color: #FFE1A0 !important;
            border-top: 1px solid var(--border);
            margin-top: 5px;
        }

        /* MAIN CONTENT */
        .main {
            padding-top: 75px;
            min-height: 100vh;
        }

        .page-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 23px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .page-header h1 {
            font-size: 22px;
            margin: 0;
            color: var(--navy);
        }

        .page-header p {
            color: var(--muted);
            font-size: 13px;
            margin: 7px 0 0;
        }

        .access-label {
            background: #FFF4D9;
            color: #785512;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .content {
            max-width: 1450px;
            margin: auto;
            padding: 30px 35px;
        }

        .welcome {
            padding: 30px;
            border-radius: 13px;
            color: white;
            background: linear-gradient(115deg, var(--navy), var(--blue));
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome:after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            border: 30px solid rgba(255, 255, 255, .06);
            border-radius: 50%;
            right: -40px;
            top: -70px;
        }

        .welcome .tag {
            display: inline-block;
            background: rgba(214, 168, 79, .18);
            color: #FFE1A0;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .welcome h2 {
            margin: 0 0 10px;
            font-size: 25px;
        }

        .welcome p {
            max-width: 680px;
            color: #E0EAF0;
            font-size: 14px;
            line-height: 1.8;
            margin: 0;
        }

        .section-heading {
            margin: 30px 0 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 18px;
            color: var(--navy);
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
            border-radius: 11px;
            padding: 22px;
            transition: transform .2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            background: #EAF1F4;
            border-radius: 10px;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin: 0;
            font-size: 25px;
            color: var(--navy);
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
            border-radius: 11px;
            padding: 23px;
            color: var(--text);
            transition: transform .2s ease, background .2s ease;
        }

        .task:hover {
            transform: translateY(-3px);
            background: #FCFDFD;
        }

        .task-icon {
            font-size: 25px;
            margin-bottom: 13px;
        }

        .task h3 {
            font-size: 15px;
            color: var(--navy);
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
            border-left: 4px solid var(--gold);
            padding: 19px;
            border-radius: 9px;
            margin-top: 27px;
            font-size: 13px;
            line-height: 1.8;
        }

        .notice strong {
            color: var(--navy);
        }

        .footer {
            border-top: 1px solid var(--border);
            margin-top: 35px;
            padding: 20px 35px;
            color: var(--muted);
            font-size: 12px;
            background: white;
        }

        /* MOBILE NAVIGATION */
        .menu-toggle {
            display: none;
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 6px;
            padding: 8px 11px;
            font-size: 20px;
            cursor: pointer;
        }

        @media (max-width: 950px) {
            .topnav {
                flex-wrap: wrap;
                padding: 12px 18px;
            }

            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                padding-top: 12px;
            }

            .nav-links.open {
                display: flex;
            }

            .nav-item {
                width: 100%;
            }

            .nav-button {
                width: 100%;
                justify-content: space-between;
            }

            .dropdown {
                position: static;
                width: 100%;
                box-shadow: none;
                border-radius: 5px;
                margin: 4px 0 8px;
            }

            .nav-item:hover .dropdown {
                display: none;
            }

            .nav-item:focus-within .dropdown {
                display: block;
            }

            .profile {
                border: 0;
                padding: 8px 0;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .page-header {
                padding: 20px;
                align-items: flex-start;
                flex-direction: column;
            }

            .content {
                padding: 20px;
            }

            .cards,
            .task-grid {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 23px;
            }

            .welcome h2 {
                font-size: 21px;
            }

            .footer {
                padding: 18px 20px;
            }
        }
    </style>
</head>

<body>

    <header class="topnav">
        <div class="brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">
            <div>
                <strong>Abuhaneefah Islamic Academy</strong>
                <small>EXAMINER PORTAL</small>
            </div>
        </div>

        <button class="menu-toggle" type="button" onclick="toggleMenu()">☰</button>

        <nav class="nav-links" id="navLinks">

            <div class="nav-item">
                <button class="nav-button" type="button">
                    Workspace <span class="arrow">▼</span>
                </button>
                <div class="dropdown">
                    <a href="{{ route('cbt.examiner.dashboard') }}">Overview</a>
                    <a href="#examinations">My Examinations</a>
                    <a href="#questions">Question Bank</a>
                </div>
            </div>

            <div class="nav-item">
                <button class="nav-button" type="button">
                    Examination Activities <span class="arrow">▼</span>
                </button>
                <div class="dropdown">
                    <a href="#examinations">Assigned Examinations</a>
                    <a href="#questions">Prepare Questions</a>
                    <a href="#submissions">Student Submissions</a>
                </div>
            </div>

            <div class="nav-item">
                <button class="nav-button" type="button">
                    Results <span class="arrow">▼</span>
                </button>
                <div class="dropdown">
                    <a href="#results">Results Review</a>
                    <a href="#policy">Result Approval Policy</a>
                </div>
            </div>

            <div class="nav-item">
                <button class="nav-button" type="button">
                    Account <span class="arrow">▼</span>
                </button>
                <div class="dropdown">
                    <a href="#profile">My Profile</a>
                    <form method="POST" action="{{ route('cbt.logout') }}">
                        @csrf
                        <button type="submit" class="nav-button logout" style="width:100%;text-align:left;">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>

        </nav>

        <div class="profile" id="profile">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="profile-name">{{ auth()->user()->name }}</span>
        </div>
    </header>

    <main class="main">

        <header class="page-header">
            <div>
                <h1>Examiner Workspace</h1>
                <p>Prepare and review examinations assigned to you.</p>
            </div>
            <span class="access-label">EXAMINER ACCESS</span>
        </header>

        <div class="content">

            <section class="welcome">
                <span class="tag">EXAMINER ACCESS</span>
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p>
                    Use this workspace to manage assigned examination activities,
                    prepare questions and review student results. Results will
                    require administrator approval before release.
                </p>
            </section>

            <div class="section-heading">
                <h2>Your Overview</h2>
                <p>Examination statistics will appear here when the modules are connected.</p>
            </div>

            <section class="cards">

                <div class="card" id="examinations">
                    <div class="card-icon">📝</div>
                    <h3>—</h3>
                    <p>Assigned Examinations</p>
                    <div class="placeholder">Examination assignments not connected yet</div>
                </div>

                <div class="card" id="questions">
                    <div class="card-icon">✎</div>
                    <h3>—</h3>
                    <p>Questions Prepared</p>
                    <div class="placeholder">Question bank not connected yet</div>
                </div>

                <div class="card" id="submissions">
                    <div class="card-icon">▥</div>
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
                    <div class="task-icon">📚</div>
                    <h3>My Examinations</h3>
                    <p>View assigned subjects, examination schedules and exam instructions.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#questions" class="task">
                    <div class="task-icon">🗂️</div>
                    <h3>Question Bank</h3>
                    <p>Prepare questions, multiple-choice options and correct answers for assigned exams.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#submissions" class="task">
                    <div class="task-icon">📋</div>
                    <h3>Student Submissions</h3>
                    <p>Review completed examination attempts and check submission records.</p>
                    <span class="status">Planned module</span>
                </a>

                <a href="#results" class="task" id="results">
                    <div class="task-icon">📊</div>
                    <h3>Results Review</h3>
                    <p>Review scores and submit results for administrator approval before publication.</p>
                    <span class="status">Planned module</span>
                </a>

            </section>

            <div class="notice" id="policy">
                <strong>Result release policy:</strong>
                Examiners can prepare and review results, but students must not
                see results until an authorised administrator approves them.
            </div>

        </div>

        <footer class="footer">
            © {{ date('Y') }} Abuhaneefah Islamic Academy.
            CBT Examiner Portal.
        </footer>

    </main>

    <script>
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('open');
        }
    </script>

</body>

</html>