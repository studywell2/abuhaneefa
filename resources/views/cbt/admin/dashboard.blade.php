<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrator Dashboard | Abuhaneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --green: #244C40;
            --green-dark: #193B32;
            --green-light: #EAF1ED;
            --gold: #B89A58;
            --cream: #F7F6F1;
            --white: #FFFFFF;
            --text: #293832;
            --muted: #78847D;
            --border: #E5E8E3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 255px;
            flex-shrink: 0;
            background: var(--green-dark);
            color: white;
            padding: 25px 18px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 5px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, .13);
        }

        .brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: white;
            border-radius: 7px;
            padding: 3px;
        }

        .brand h2 {
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
            font-weight: 650;
        }

        .brand small {
            display: block;
            color: #D7BE83;
            font-size: 10px;
            letter-spacing: 1px;
            margin-top: 3px;
        }

        .nav-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: #A9BDB4;
            margin: 29px 10px 11px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #DCE6E0;
            padding: 12px;
            margin-bottom: 4px;
            border-radius: 5px;
            font-size: 13px;
            transition: .2s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, .09);
            color: white;
        }

        .nav-link.active {
            background: #315D4E;
            color: white;
            border-left: 3px solid #D7BE83;
        }

        .nav-icon {
            width: 21px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 8px;
            margin-bottom: 12px;
            border-top: 1px solid rgba(255, 255, 255, .13);
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #D7BE83;
            color: var(--green-dark);
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        .profile strong {
            display: block;
            font-size: 12px;
        }

        .profile small {
            font-size: 10px;
            color: #B6C7BE;
        }

        .logout {
            width: 100%;
            padding: 11px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, .25);
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: .2s;
        }

        .logout:hover {
            background: #9C4943;
            border-color: #9C4943;
        }

        /* MAIN */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            height: 79px;
            padding: 15px 32px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .topbar h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 650;
            color: var(--green-dark);
        }

        .topbar p {
            margin: 5px 0 0;
            font-size: 12px;
            color: var(--muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date {
            font-size: 12px;
            color: var(--muted);
        }

        .user {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 12px;
            font-weight: 600;
        }

        .avatar {
            width: 37px;
            height: 37px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--green-light);
            color: var(--green);
            font-weight: 700;
        }

        .content {
            max-width: 1600px;
            margin: auto;
            padding: 29px 32px;
        }

        /* CAROUSEL */

        .carousel {
            position: relative;
            overflow: hidden;
            background: var(--green);
            color: white;
            margin-bottom: 30px;
            border-radius: 7px;
        }

        .carousel-track {
            display: flex;
            transition: transform .6s ease;
        }

        .slide {
            min-width: 100%;
            min-height: 230px;
            padding: 37px 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .slide-content {
            max-width: 650px;
        }

        .slide-label {
            color: #E1CB91;
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .slide h2 {
            font-size: 27px;
            line-height: 1.3;
            margin: 13px 0 10px;
            font-weight: 650;
        }

        .slide p {
            font-size: 13px;
            color: #E0E9E3;
            line-height: 1.8;
            margin: 0;
        }

        .slide-link {
            display: inline-block;
            background: #D7BE83;
            color: #243F33;
            padding: 11px 17px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 650;
            margin-top: 20px;
            transition: .2s;
        }

        .slide-link:hover {
            background: white;
            transform: translateY(-2px);
        }

        .slide-number {
            font-size: 85px;
            font-weight: 300;
            color: rgba(255, 255, 255, .13);
            padding-right: 35px;
        }

        .slide:nth-child(2) {
            background: #365C4D;
        }

        .slide:nth-child(3) {
            background: #344D43;
        }

        .carousel-controls {
            position: absolute;
            bottom: 17px;
            left: 45px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carousel-dots {
            display: flex;
            gap: 6px;
        }

        .carousel-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            border: 0;
            border-radius: 10px;
            background: rgba(255, 255, 255, .4);
            cursor: pointer;
            transition: .2s;
        }

        .carousel-dot.active {
            width: 21px;
            background: #D7BE83;
        }

        .carousel-arrow {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, .4);
            border-radius: 3px;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .carousel-arrow:hover {
            background: rgba(255, 255, 255, .15);
        }

        /* SECTION HEADINGS */

        .section-heading {
            margin: 30px 0 17px;
        }

        .section-heading h2 {
            font-size: 17px;
            color: var(--green-dark);
            margin: 0;
            font-weight: 650;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 12px;
            margin: 6px 0 0;
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            padding: 21px;
            border-radius: 6px;
            transition: border-color .25s, transform .25s;
        }

        .stat-card:hover {
            border-color: #B7A477;
            transform: translateY(-3px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-icon {
            color: var(--green);
            background: var(--green-light);
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            border-radius: 5px;
            font-size: 18px;
        }

        .stat-card h3 {
            margin: 19px 0 5px;
            font-size: 27px;
            color: var(--green-dark);
        }

        .stat-card p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-card small {
            display: block;
            margin-top: 12px;
            color: #A0A9A2;
            font-size: 10px;
        }

        /* MANAGEMENT GRID */

        .management-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .management-card {
            background: white;
            border: 1px solid var(--border);
            padding: 22px;
            border-radius: 6px;
            min-height: 205px;
            display: flex;
            flex-direction: column;
            color: var(--text);
            transition: border-color .25s, transform .25s, box-shadow .25s;
        }

        .management-card:hover {
            border-color: #B7A477;
            transform: translateY(-4px);
            box-shadow: 0 7px 18px rgba(31, 58, 44, .06);
        }

        .management-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            background: var(--green-light);
            color: var(--green);
            border-radius: 5px;
            font-size: 19px;
            margin-bottom: 17px;
        }

        .management-card h3 {
            font-size: 14px;
            font-weight: 650;
            color: var(--green-dark);
            margin: 0 0 9px;
        }

        .management-card p {
            font-size: 12px;
            line-height: 1.8;
            color: var(--muted);
            margin: 0;
        }

        .management-footer {
            margin-top: auto;
            padding-top: 17px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status {
            font-size: 10px;
            color: #866C35;
            background: #F5F0E3;
            padding: 6px 9px;
            border-radius: 3px;
        }

        .status.available {
            background: #E8F1EB;
            color: #376A4C;
        }

        .arrow {
            color: var(--gold);
            font-size: 17px;
            transition: transform .2s;
        }

        .management-card:hover .arrow {
            transform: translateX(4px);
        }

        /* INFORMATION */

        .notice {
            background: #F0F2EC;
            border-left: 3px solid var(--gold);
            padding: 17px 20px;
            margin-top: 28px;
        }

        .notice h3 {
            font-size: 13px;
            margin: 0 0 6px;
            color: var(--green-dark);
        }

        .notice p {
            font-size: 11px;
            line-height: 1.7;
            margin: 0;
            color: var(--muted);
        }

        /* FOOTER */

        .footer {
            padding: 20px 32px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: var(--muted);
            font-size: 11px;
        }

        /* RESPONSIVE */

        @media(max-width: 1050px) {
            .sidebar {
                width: 225px;
            }

            .content {
                padding: 24px;
            }

            .management-grid,
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 700px) {
            .app {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 17px;
            }

            .sidebar nav {
                display: flex;
                overflow-x: auto;
                gap: 5px;
                padding-top: 15px;
            }

            .nav-label {
                display: none;
            }

            .nav-link {
                flex-shrink: 0;
                white-space: nowrap;
                margin: 0;
            }

            .sidebar-bottom {
                padding-top: 15px;
            }

            .profile {
                display: none;
            }

            .topbar {
                padding: 15px 18px;
                height: auto;
            }

            .topbar h1 {
                font-size: 17px;
            }

            .topbar p {
                font-size: 11px;
            }

            .date {
                display: none;
            }

            .user span {
                display: none;
            }

            .content {
                padding: 19px 16px;
            }

            .slide {
                padding: 28px 25px 60px;
                min-height: 245px;
            }

            .slide h2 {
                font-size: 22px;
            }

            .slide-number {
                font-size: 55px;
                padding: 0;
            }

            .carousel-controls {
                left: 25px;
            }

            .footer {
                padding: 18px;
                flex-direction: column;
            }
        }

        @media(max-width: 520px) {

            .management-grid,
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .slide-number {
                display: none;
            }
        }

        @media(prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div class="app">

        <!-- SIDEBAR -->

        <aside class="sidebar">

            <div class="brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">

                <h2>
                    Abuhaneefah Islamic Academy
                    <small>CBT MANAGEMENT PORTAL</small>
                </h2>
            </div>

            <nav>

                <div class="nav-label">Main Menu</div>

                <a href="{{ route('cbt.admin.dashboard') }}" class="nav-link active">
                    <span class="nav-icon">⌂</span>
                    Overview
                </a>

                <div class="nav-label">Academic Management</div>

                <a href="{{ route('cbt.admin.students.index') }}" class="nav-link">
                    <span class="nav-icon">♙</span>
                    Students
                </a>

                <a href="{{ route('cbt.admin.examiners.index') }}" class="nav-link">
                    <span class="nav-icon">♧</span>
                    Examiners
                </a>

                <a href="{{ route('cbt.admin.examinations.index') }}" class="nav-link">
                    <span class="nav-icon">▤</span>
                    Examinations
                </a>

                <a href="{{ route('cbt.admin.results.index') }}" class="nav-link">
                    <span class="nav-icon">▥</span>
                    Results & Approval
                </a>

                <div class="nav-label">Administration</div>

                <a href="{{ route('cbt.admin.result-pins.index') }}" class="nav-link">
                    <span class="nav-icon">◇</span>
                    Result PINs
                </a>

            </nav>

            <div class="sidebar-bottom">

                <div class="profile">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>Administrator</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('cbt.logout') }}">
                    @csrf
                    <button type="submit" class="logout">
                        ↪ &nbsp; Sign Out
                    </button>
                </form>

            </div>

        </aside>


        <!-- MAIN CONTENT -->

        <main class="main">

            <header class="topbar">

                <div>
                    <h1>Dashboard</h1>
                    <p>Administrator workspace</p>
                </div>

                <div class="topbar-right">

                    <div class="date" id="currentDate"></div>

                    <div class="user">
                        <div class="avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span>{{ auth()->user()->name }}</span>
                    </div>

                </div>

            </header>


            <div class="content">

                <!-- CAROUSEL -->

                <section class="carousel">

                    <div class="carousel-track" id="carouselTrack">

                        <div class="slide">

                            <div class="slide-content">
                                <span class="slide-label">Administration</span>

                                <h2>
                                    Welcome back, {{ auth()->user()->name }}.
                                </h2>

                                <p>
                                    Manage your academy's computer-based
                                    examination activities from one central
                                    administration workspace.
                                </p>

                                <a href="{{ route('cbt.admin.students.index') }}" class="slide-link">
                                    Manage Students →
                                </a>
                            </div>

                            <div class="slide-number">01</div>

                        </div>


                        <div class="slide">

                            <div class="slide-content">
                                <span class="slide-label">Academic Management</span>

                                <h2>Organise Your Academic Activities.</h2>

                                <p>
                                    Keep student information organised and
                                    manage the examination process as the
                                    academy's CBT system develops.
                                </p>

                                <a href="{{ route('cbt.admin.examinations.index') }}" class="slide-link">
                                    Examination Management →
                                </a>
                            </div>

                            <div class="slide-number">02</div>

                        </div>


                        <div class="slide">

                            <div class="slide-content">
                                <span class="slide-label">Results & Administration</span>

                                <h2>Responsible Examination Management.</h2>

                                <p>
                                    Support proper result verification,
                                    administrative approval and secure access
                                    to examination records.
                                </p>

                                <a href="{{ route('cbt.admin.results.index') }}" class="slide-link">
                                    Review Results →
                                </a>
                            </div>

                            <div class="slide-number">03</div>

                        </div>

                    </div>

                    <div class="carousel-controls">

                        <button type="button" class="carousel-arrow" id="prevSlide"
                            aria-label="Previous slide">‹</button>

                        <div class="carousel-dots">
                            <button type="button" class="carousel-dot active" data-slide="0"
                                aria-label="Slide 1"></button>

                            <button type="button" class="carousel-dot" data-slide="1" aria-label="Slide 2"></button>

                            <button type="button" class="carousel-dot" data-slide="2" aria-label="Slide 3"></button>
                        </div>

                        <button type="button" class="carousel-arrow" id="nextSlide" aria-label="Next slide">›</button>

                    </div>

                </section>


                <!-- OVERVIEW -->

                <div class="section-heading">
                    <h2>Portal Overview</h2>
                    <p>A summary of the academy's examination management activities.</p>
                </div>


                <section class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">♙</div>
                        </div>

                        <h3>{{ $registeredStudents }}</h3>
                        <p>Registered Students</p>
                        <small>Total students registered in the academy's CBT portal</small>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">♧</div>
                        </div>

                        <h3>{{ $registeredExaminers }}</h3>
                        <p>Registered Examiners</p>
                        <small>Total examiner accounts registered in the portal</small>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">▤</div>
                        </div>

                        <h3>{{ $totalExaminations }}</h3>
                        <p>Examinations</p>
                        <small>Total examinations created in the portal</small>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">▥</div>
                        </div>

                        <h3>{{ $resultsAwaitingApproval }}</h3>
                        <p>Results Awaiting Approval</p>
                        <small>Results waiting for administrator approval</small>
                    </div>

                </section>


                <!-- MANAGEMENT CENTRE -->

                <div class="section-heading">
                    <h2>Management Centre</h2>
                    <p>Select an area to manage the CBT portal.</p>
                </div>


                <section class="management-grid">

                    <!-- STUDENT MANAGEMENT -->

                    <a href="{{ route('cbt.admin.students.index') }}" class="management-card">

                        <div class="management-icon">♙</div>

                        <h3>Student Management</h3>

                        <p>
                            Register students, update their information,
                            manage student profiles and assign unique
                            identification numbers.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- EXAMINER MANAGEMENT -->

                    <a href="{{ route('cbt.admin.examiners.index') }}" class="management-card">

                        <div class="management-icon">♧</div>

                        <h3>Examiner Management</h3>

                        <p>
                            Register examiners, update their information,
                            manage account status and control access
                            to examination responsibilities.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- EXAMINATION MANAGEMENT -->

                    <a href="{{ route('cbt.admin.examinations.index') }}" class="management-card">

                        <div class="management-icon">▤</div>

                        <h3>Examination Management</h3>

                        <p>
                            Organise subjects, examination questions,
                            answer options, duration and schedules.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- QUESTIONS AND EXAMINER ASSIGNMENTS -->

                    <a href="{{ route('cbt.admin.examinations.index') }}" class="management-card">

                        <div class="management-icon">✎</div>

                        <h3>Questions & Examiner Assignments</h3>

                        <p>
                            Select an examination to create and manage
                            questions, edit answer options and assign
                            examiners to examination tasks.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- RESULTS AND APPROVAL -->

                    <a href="{{ route('cbt.admin.results.index') }}" class="management-card">

                        <div class="management-icon">▥</div>

                        <h3>Results &amp; Approval</h3>

                        <p>
                            Review submitted results and approve them
                            before students can access their results.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- RESULT PIN MANAGEMENT -->

                    <a href="{{ route('cbt.admin.result-pins.index') }}" class="management-card">

                        <div class="management-icon">◇</div>

                        <h3>Result PIN Management</h3>

                        <p>
                            Record payments, generate student-specific
                            Result PINs, view issued PIN records and manage
                            their validity across two consecutive terms.
                        </p>

                        <div class="management-footer">
                            <span class="status available">Available</span>
                            <span class="arrow">→</span>
                        </div>

                    </a>


                    <!-- PORTAL SETTINGS -->

                    <div class="management-card">

                        <div class="management-icon">⚙</div>

                        <h3>Portal Settings</h3>

                        <p>
                            Configure academic sessions, terms
                            and other examination portal settings.
                        </p>

                        <div class="management-footer">
                            <span class="status">Not Available</span>
                            <span class="arrow">—</span>
                        </div>

                    </div>

                </section>


                <!-- SYSTEM INFORMATION -->

                <section class="notice">
                    <h3>System Information</h3>

                    <p>
                        The CBT Management Portal provides centralised
                        management of student records, examinations,
                        examiner assignments, result approval and
                        secure student result access.
                    </p>
                </section>


                <!-- FOOTER -->

                <footer class="footer">
                    <span>
                        © {{ date('Y') }} Abuhaneefah Islamic Academy.
                    </span>

                    <span>CBT Management Portal</span>
                </footer>

            </div>

        </main>

    </div>


    <!-- JAVASCRIPT -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // DATE

            document.getElementById('currentDate').textContent =
                new Intl.DateTimeFormat('en-GB', {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                }).format(new Date());


            // CAROUSEL

            const track = document.getElementById('carouselTrack');
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.carousel-dot');

            const next = document.getElementById('nextSlide');
            const prev = document.getElementById('prevSlide');

            const carousel = document.querySelector('.carousel');

            let current = 0;
            let timer;
            let touchStart = 0;

            function showSlide(index) {

                current = (index + slides.length) % slides.length;

                track.style.transform = `translateX(-${current * 100}%)`;

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === current);
                });
            }

            function startTimer() {
                clearInterval(timer);
                timer = setInterval(() => showSlide(current + 1), 6500);
            }

            next.addEventListener('click', () => {
                showSlide(current + 1);
                startTimer();
            });

            prev.addEventListener('click', () => {
                showSlide(current - 1);
                startTimer();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    startTimer();
                });
            });

            carousel.addEventListener('mouseenter', () => clearInterval(timer));
            carousel.addEventListener('mouseleave', startTimer);

            carousel.addEventListener('touchstart', event => {
                touchStart = event.changedTouches[0].screenX;
                clearInterval(timer);
            }, { passive: true });

            carousel.addEventListener('touchend', event => {

                const touchEnd = event.changedTouches[0].screenX;
                const difference = touchStart - touchEnd;

                if (Math.abs(difference) > 45) {
                    showSlide(current + (difference > 0 ? 1 : -1));
                }

                startTimer();

            }, { passive: true });

            showSlide(0);
            startTimer();

        });
    </script>

</body>

</html>
