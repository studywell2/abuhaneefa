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
            box-shadow: 0 3px 12px rgba(0,0,0,.12);
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
        }

        .nav-button:hover,
        .nav-item:hover > .nav-button {
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
            box-shadow: 0 10px 30px rgba(0,0,0,.16);
            z-index: 1100;
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
        }

        .dropdown a:hover {
            background: #EAF1F4;
            color: var(--navy);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 9px;
            padding-left: 15px;
            border-left: 1px solid rgba(255,255,255,.2);
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
            color: #785512 !important;
            border: 0;
            background: transparent;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 13px;
            padding: 11px 12px;
        }

        .logout:hover {
            background: #FFF4D9;
        }

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
            border: 30px solid rgba(255,255,255,.06);
            border-radius: 50%;
            right: -40px;
            top: -70px;
        }

        .welcome .tag {
            display: inline-block;
            background: rgba(214,168,79,.18);
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
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border-radius: 11px;
            padding: 22px;
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

        .table-card {
            background: white;
            border-radius: 11px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1080px;
        }

        th, td {
            padding: 15px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
        }

        th {
            background: #F7FAFC;
            color: var(--navy);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        td {
            color: var(--text);
        }

        tbody tr:hover {
            background: #FAFCFD;
        }

        .exam-title {
            font-weight: bold;
            color: var(--navy);
        }

        .department-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #EAF1F4;
            color: var(--navy);
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .department-general {
            background: #FFF4D9;
            color: #785512;
        }

        .department-na {
            background: #EDF0F3;
            color: #526170;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-published {
            background: #E6F5EC;
            color: #237344;
        }

        .status-completed {
            background: #EAF1F8;
            color: #315C72;
        }

        .status-draft {
            background: #FFF4D9;
            color: #785512;
        }

        .status-other {
            background: #EDF0F3;
            color: #526170;
        }

        .score-link {
            display: inline-block;
            background: var(--navy);
            color: white;
            padding: 9px 13px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
            transition: background .2s ease;
        }

        .score-link:hover {
            background: var(--blue);
            color: white;
        }

        .filter-notice {
            background: #EAF1F4;
            border-left: 4px solid var(--blue);
            padding: 16px 19px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.7;
        }

        .filter-notice strong {
            color: var(--navy);
        }

        .clear-filter {
            display: inline-block;
            margin-top: 8px;
            color: var(--navy);
            font-weight: bold;
            text-decoration: underline;
        }

        .empty-state {
            padding: 45px 20px;
            text-align: center;
        }

        .empty-state .icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 16px;
            margin: 0 0 8px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
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

        .pagination {
            padding: 18px;
            border-top: 1px solid var(--border);
        }

        .footer {
            border-top: 1px solid var(--border);
            margin-top: 35px;
            padding: 20px 35px;
            color: var(--muted);
            font-size: 12px;
            background: white;
        }

        .menu-toggle {
            display: none;
            background: transparent;
            color: white;
            border: 1px solid rgba(255,255,255,.3);
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
                margin: 4px 0 8px;
            }

            .profile {
                border: 0;
                padding: 8px 0;
            }

            .cards {
                grid-template-columns: repeat(2,minmax(0,1fr));
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

            .cards {
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

        {{-- DASHBOARD --}}
        <div class="nav-item">
            <button class="nav-button" type="button">
                Dashboard <span class="arrow">▼</span>
            </button>

            <div class="dropdown">
                <a href="{{ route('cbt.examiner.dashboard') }}">
                    Overview
                </a>
            </div>
        </div>

        {{-- ASSIGNED EXAMINATIONS --}}
        <div class="nav-item">
            <button class="nav-button" type="button">
                My Examinations <span class="arrow">▼</span>
            </button>

            <div class="dropdown">
                <a href="{{ route('cbt.examiner.dashboard') }}#examinations">
                    Assigned Examinations
                </a>
            </div>
        </div>

        {{-- SCORE MANAGEMENT --}}
        <div class="nav-item">
            <button class="nav-button" type="button">
                Score Management <span class="arrow">▼</span>
            </button>

            <div class="dropdown">
                <a href="{{ route('cbt.examiner.dashboard', ['score_task' => 'entry']) }}#examinations">
                    Enter Student Scores
                </a>

                <a href="{{ route('cbt.examiner.dashboard', ['score_task' => 'review']) }}#examinations">
                    Review &amp; Submit Scores
                </a>
            </div>
        </div>

        {{-- ACCOUNT --}}
        <div class="nav-item">
            <button class="nav-button" type="button">
                Account <span class="arrow">▼</span>
            </button>

            <div class="dropdown">
                <form method="POST" action="{{ route('cbt.logout') }}">
                    @csrf

                    <button type="submit" class="logout">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

    </nav>

    {{-- EXAMINER PROFILE --}}
    <div class="profile">
        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <span class="profile-name">
            {{ auth()->user()->name }}
        </span>
    </div>

</header>

<main class="main">

    {{-- PAGE HEADER --}}
    <header class="page-header">
        <div>
            <h1>Examiner Workspace</h1>
            <p>Manage examinations assigned to you.</p>
        </div>

        <span class="access-label">EXAMINER ACCESS</span>
    </header>

    <div class="content">

        {{-- WELCOME SECTION --}}
        <section class="welcome">
            <span class="tag">EXAMINER ACCESS</span>

            <h2>Welcome, {{ auth()->user()->name }}!</h2>

            <p>
                This is your examination workspace. View your assigned examinations
                and access submitted student records. You can enter and review
                scores according to the examination workflow.
            </p>
        </section>

        {{-- DASHBOARD STATISTICS --}}
        <div class="section-heading">
            <h2>Your Overview</h2>
            <p>Summary of your examination assignments.</p>
        </div>

        <section class="cards">

            <div class="card">
                <div class="card-icon">📝</div>
                <h3>{{ $totalAssigned }}</h3>
                <p>Total Assigned Examinations</p>
            </div>

            <div class="card">
                <div class="card-icon">📅</div>
                <h3>{{ $publishedExams }}</h3>
                <p>Published Examinations</p>
            </div>

            <div class="card">
                <div class="card-icon">✓</div>
                <h3>{{ $completedExams }}</h3>
                <p>Completed Examinations</p>
            </div>

        </section>

        {{-- ASSIGNED EXAMINATIONS --}}
        <div class="section-heading" id="examinations">

            @if($scoreTask === 'entry')

                <h2>Examinations Awaiting Score Entry</h2>
                <p>Examinations with submitted student records awaiting scores.</p>

            @elseif($scoreTask === 'review')

                <h2>Examinations Awaiting Review</h2>
                <p>Examinations with completed scores awaiting your review.</p>

            @else

                <h2>My Assigned Examinations</h2>
                <p>Only examinations assigned to your account are displayed here.</p>

            @endif

        </div>

        {{-- FILTER INFORMATION --}}
        @if(in_array($scoreTask, ['entry', 'review'], true))

            <div class="filter-notice">

                @if($scoreTask === 'entry')

                    <strong>Score Entry Filter:</strong>
                    The list below contains examinations with submitted student records
                    whose results are awaiting score entry.

                @else

                    <strong>Result Review Filter:</strong>
                    The list below contains examinations with student results
                    awaiting examiner review.

                @endif

                <br>

                <a
                    href="{{ route('cbt.examiner.dashboard') }}#examinations"
                    class="clear-filter"
                >
                    View All Assigned Examinations
                </a>

            </div>

        @endif

        <section class="table-card">

            @if($examinations->count() > 0)

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Examination</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Department</th>
                                <th>Academic Year</th>
                                <th>Term</th>
                                <th>Mode</th>
                                <th>Questions</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($examinations as $index => $examination)

                                @php
                                    $statusClass = match($examination->status) {
                                        'published' => 'status-published',
                                        'completed' => 'status-completed',
                                        'draft' => 'status-draft',
                                        default => 'status-other',
                                    };

                                    $className = strtoupper(
                                        $examination->schoolClass->name ?? ''
                                    );

                                    $isSeniorClass = str_starts_with($className, 'SS');

                                    $department = $isSeniorClass
                                        ? ($examination->department ?? 'General')
                                        : 'Not applicable';
                                @endphp

                                <tr>
                                    <td>
                                        {{ $examinations->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <span class="exam-title">
                                            {{ $examination->title }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $examination->subject }}
                                    </td>

                                    <td>
                                        {{ $examination->schoolClass->name ?? 'Not specified' }}
                                    </td>

                                    <td>
                                        @if($isSeniorClass)

                                            <span class="department-badge {{ $department === 'General' ? 'department-general' : '' }}">
                                                {{ $department }}
                                            </span>

                                        @else

                                            <span class="department-badge department-na">
                                                Not applicable
                                            </span>

                                        @endif
                                    </td>

                                    <td>
                                        {{ $examination->academic_year }}
                                    </td>

                                    <td>
                                        {{ $examination->term }}
                                    </td>

                                    <td>
                                        {{ ucfirst($examination->mode) }}
                                    </td>

                                    <td>
                                        {{ $examination->questions_count }}
                                    </td>

                                    <td>
                                        <span class="status {{ $statusClass }}">
                                            {{ str_replace('_', ' ', $examination->status) }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($scoreTask === 'entry')

                                            <a
                                                href="{{ route('cbt.examiner.examinations.scores.index', ['examination' => $examination, 'task' => 'entry']) }}"
                                                class="score-link"
                                            >
                                                Enter Student Scores
                                            </a>

                                        @elseif($scoreTask === 'review')

                                            <a
                                                href="{{ route('cbt.examiner.examinations.scores.index', ['examination' => $examination, 'task' => 'review']) }}"
                                                class="score-link"
                                            >
                                                Review Student Scores
                                            </a>

                                        @else

                                            <a
                                                href="{{ route('cbt.examiner.examinations.scores.index', $examination) }}"
                                                class="score-link"
                                            >
                                                View Student Scores
                                            </a>

                                        @endif

                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="pagination">
                    {{ $examinations->links() }}
                </div>

            @else

                {{-- FILTER-SPECIFIC EMPTY STATES --}}
                <div class="empty-state">

                    @if($scoreTask === 'entry')

                        <div class="icon">📝</div>

                        <h3>No Scores Awaiting Entry</h3>

                        <p>
                            There are currently no assigned examinations with
                            submitted student records awaiting score entry.
                        </p>

                    @elseif($scoreTask === 'review')

                        <div class="icon">✓</div>

                        <h3>No Results Awaiting Review</h3>

                        <p>
                            There are currently no assigned examinations with
                            student results awaiting your review.
                        </p>

                    @else

                        <div class="icon">📚</div>

                        <h3>No Examinations Assigned Yet</h3>

                        <p>
                            You currently have no examination assignments.
                            Please contact the administrator if you believe
                            an examination should have been assigned to you.
                        </p>

                    @endif

                </div>

            @endif

        </section>

        {{-- RESULT APPROVAL NOTICE --}}
        <div class="notice">
            <strong>Result release policy:</strong>

            Examiners may enter and review assigned examination scores.
            However, students must not see their results until an authorised
            administrator has approved them.
        </div>

    </div>

    {{-- FOOTER --}}
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