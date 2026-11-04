
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Abu Haneefah Islamic Academy</title>
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
            color: var(--white);
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

        .nav-item.active {
            background: var(--blue);
            border-left: 4px solid var(--gold);
        }

        .nav-item:hover {
            background: #315c72;
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
            gap: 15px;
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
            max-width: 1400px;
            margin: auto;
        }

        .welcome {
            background: linear-gradient(120deg, var(--navy), var(--blue));
            color: white;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 25px;
            border-bottom: 4px solid var(--gold);
        }

        .welcome h2 {
            margin: 0 0 10px;
            font-size: 25px;
        }

        .welcome p {
            margin: 0;
            line-height: 1.7;
            color: #e3edf1;
            font-size: 14px;
        }

        .section-heading {
            color: var(--navy);
            margin: 30px 0 15px;
            font-size: 19px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 3px 12px #173b4d08;
        }

        .card-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            background: #eaf1f4;
            border-radius: 10px;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin: 0 0 9px;
            font-size: 16px;
            color: var(--navy);
        }

        .card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .status {
            display: inline-block;
            margin-top: 14px;
            background: #fff5dd;
            color: #805b12;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .exam-button {
            display: inline-block;
            margin-top: 14px;
            background: var(--navy);
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .exam-button:hover {
            background: var(--blue);
        }

        .notice {
            background: white;
            border: 1px solid #e2e8f0;
            border-left: 4px solid var(--gold);
            border-radius: 8px;
            padding: 18px;
            margin-top: 25px;
        }

        .notice h3 {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 15px;
        }

        .notice p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        footer {
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content {
                padding: 20px;
            }
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

            .cards {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 22px;
            }

            .welcome h2 {
                font-size: 21px;
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

        <a href="{{ route('cbt.student.dashboard') }}" class="nav-item active">
            My Dashboard
        </a>

        <a href="{{ route('cbt.student.examinations.index') }}" class="nav-item">
            Available Examinations
        </a>

        <a href="#my-results" class="nav-item">
            My Results
        </a>

        <a href="#result-pin" class="nav-item">
            Result PIN
        </a>

        <p class="nav-title">Account</p>

        <form method="POST" action="{{ route('cbt.logout') }}">
            @csrf
            <button type="submit" class="nav-item"
                    style="width:100%; text-align:left; border:0; cursor:pointer; background:transparent;">
                Log Out
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Student Dashboard</h1>
                <p>Welcome to your online examination portal.</p>
            </div>

            <form method="POST" action="{{ route('cbt.logout') }}">
                @csrf
                <button type="submit" class="logout">Log Out</button>
            </form>
        </header>

        <div class="content">

            <section class="welcome">
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p>
                    This is your personal examination portal.
                    You will be able to access examinations assigned to you,
                    take available tests, and view your results after they
                    have been reviewed and approved by the school administrator.
                </p>
            </section>

            <h2 class="section-heading">Your Examination Centre</h2>

            <div class="cards">

                <article class="card" id="available-exams">
                    <div class="card-icon">📝</div>
                    <h3>Available Examinations</h3>
                    <p>
                        View examinations assigned to you, including their
                        instructions, schedules, and duration.
                    </p>

                    <a href="{{ route('cbt.student.examinations.index') }}"
                       class="exam-button">
                        View Examinations
                    </a>
                </article>

                <article class="card">
                    <div class="card-icon">💻</div>
                    <h3>Take an Examination</h3>
                    <p>
                        Complete your computer-based tests online or at
                        the school's computer centre when an examination
                        is available to you.
                    </p>
                    <span class="status">Module in development</span>
                </article>

                <article class="card" id="my-results">
                    <div class="card-icon">📊</div>
                    <h3>My Results</h3>
                    <p>
                        View your approved examination results when they
                        are released by the school administrator.
                    </p>
                    <span class="status">Module in development</span>
                </article>

                <article class="card" id="result-pin">
                    <div class="card-icon">🔐</div>
                    <h3>Result PIN</h3>
                    <p>
                        Use your school-issued result PIN to unlock eligible
                        approved results during its validity period.
                    </p>
                    <span class="status">Module in development</span>
                </article>

                <article class="card">
                    <div class="card-icon">📄</div>
                    <h3>Print Result Slip</h3>
                    <p>
                        Access a printable, school-branded result slip
                        for eligible results after they have been approved
                        and unlocked.
                    </p>
                    <span class="status">Module in development</span>
                </article>

                <article class="card">
                    <div class="card-icon">👤</div>
                    <h3>My Account</h3>
                    <p>
                        Your portal is linked to your registered student
                        account. Keep your login details private.
                    </p>
                    <span class="status">Account details to be added</span>
                </article>

            </div>

            <section class="notice">
                <h3>Important Examination Information</h3>
                <p>
                    A result PIN is for viewing eligible results only.
                    You do not need a result PIN to sit for an examination.
                    Results will become accessible only after the school
                    administrator has approved their release.
                </p>
            </section>

        </div>

        <footer>
            Abu Haneefah Islamic Academy · Computer-Based Testing Portal
        </footer>
    </main>
</div>
</body>
</html>
