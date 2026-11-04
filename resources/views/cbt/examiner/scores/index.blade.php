<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Scores | Abuhaneefah Islamic Academy</title>

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
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a { text-decoration: none; }

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

        .nav-item { position: relative; }

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

        .arrow { font-size: 10px; color: var(--gold); }

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

        .logout:hover { background: #FFF4D9; }

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

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            font-size: 12px;
            color: var(--muted);
        }

        .breadcrumb a {
            color: var(--blue);
            font-weight: bold;
        }

        .breadcrumb span:last-child {
            color: var(--navy);
            font-weight: bold;
        }

        .exam-banner {
            background: linear-gradient(115deg, var(--navy), var(--blue));
            color: white;
            padding: 27px 30px;
            border-radius: 13px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .exam-banner:after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 28px solid rgba(255,255,255,.06);
            border-radius: 50%;
            right: -35px;
            top: -75px;
        }

        .exam-label {
            display: inline-block;
            background: rgba(214,168,79,.18);
            color: #FFE1A0;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 13px;
        }

        .exam-banner h2 {
            font-size: 23px;
            margin: 0 0 8px;
        }

        .exam-banner p {
            color: #E0EAF0;
            font-size: 13px;
            margin: 0;
            line-height: 1.7;
        }

        .exam-meta {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid rgba(255,255,255,.17);
        }

        .exam-meta small {
            display: block;
            color: #BFD0DA;
            font-size: 10px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .exam-meta strong {
            font-size: 13px;
            color: white;
        }

        .section-heading { margin: 30px 0 16px; }

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

        .summary-card {
            background: white;
            border-radius: 11px;
            padding: 21px;
            border: 1px solid var(--border);
        }

        .summary-card .label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 11px;
        }

        .summary-card h3 {
            color: var(--navy);
            font-size: 25px;
            margin: 0;
        }

        .summary-card p {
            color: var(--muted);
            font-size: 11px;
            margin: 8px 0 0;
        }

        .table-card {
            background: white;
            border-radius: 11px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 21px 23px;
            border-bottom: 1px solid var(--border);
        }

        .table-top h3 {
            color: var(--navy);
            font-size: 15px;
            margin: 0;
        }

        .table-top p {
            color: var(--muted);
            font-size: 11px;
            margin: 6px 0 0;
        }

        .student-count {
            background: #EAF1F4;
            color: var(--navy);
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .table-responsive { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1250px;
        }

        th, td {
            padding: 15px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
            vertical-align: top;
        }

        th {
            background: #F7FAFC;
            color: var(--navy);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        td { color: var(--text); }

        tbody tr:hover { background: #FAFCFD; }

        .student-name {
            color: var(--navy);
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }

        .student-sub {
            color: var(--muted);
            font-size: 10px;
        }

        .score-value {
            font-weight: bold;
            color: var(--navy);
        }

        .score-pending {
            color: #A16D12;
            font-size: 11px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-awaiting {
            background: #FFF4D9;
            color: #785512;
        }

        .status-review {
            background: #EAF1F8;
            color: #315C72;
        }

        .status-approval {
            background: #E9E9FF;
            color: #4646A0;
        }

        .status-approved {
            background: #E6F5EC;
            color: #237344;
        }

        .status-rejected {
            background: #FDECEC;
            color: #A52B2B;
        }

        .status-other {
            background: #EDF0F3;
            color: #526170;
        }

        .score-form {
            min-width: 190px;
            padding: 12px;
            background: #F7FAFC;
            border: 1px solid var(--border);
            border-radius: 9px;
        }

        .score-form label {
            display: block;
            color: var(--navy);
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .score-form input {
            width: 100%;
            padding: 9px;
            margin-bottom: 11px;
            border: 1px solid #CBD5E0;
            border-radius: 6px;
            font-size: 12px;
            font-family: inherit;
        }

        .score-form input:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 2px rgba(49,92,114,.12);
        }

        .save-score {
            width: 100%;
            padding: 10px;
            border: 0;
            border-radius: 6px;
            background: var(--navy);
            color: white;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-score:hover { background: var(--blue); }

        .locked-note {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
            min-width: 150px;
        }

        .review-button {
            display: inline-block;
            background: var(--blue);
            color: white;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .review-button:hover {
            background: var(--navy);
            color: white;
        }

        .success-message {
            background: #E6F5EC;
            color: #237344;
            border: 1px solid #B7E4C7;
            border-radius: 8px;
            padding: 13px 16px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .error-message {
            background: #FDECEC;
            color: #A52B2B;
            border: 1px solid #F5C2C2;
            border-radius: 8px;
            padding: 13px 16px;
            margin-bottom: 18px;
            font-size: 12px;
            line-height: 1.7;
        }

        .empty-state {
            padding: 55px 20px;
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
            margin-top: 25px;
            font-size: 12px;
            line-height: 1.8;
            color: var(--muted);
        }

        .notice strong { color: var(--navy); }

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

            .menu-toggle { display: block; }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                padding-top: 12px;
            }

            .nav-links.open { display: flex; }

            .nav-item { width: 100%; }

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

            .cards { grid-template-columns: repeat(2,minmax(0,1fr)); }
        }

        @media (max-width: 650px) {
            .page-header {
                padding: 20px;
                align-items: flex-start;
                flex-direction: column;
            }

            .content { padding: 20px; }

            .cards { grid-template-columns: 1fr; }

            .exam-banner { padding: 23px; }

            .exam-banner h2 { font-size: 20px; }

            .exam-meta { gap: 18px; }

            .table-top {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .footer { padding: 18px 20px; }
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
                <a href="{{ route('cbt.examiner.dashboard') }}#examinations">My Examinations</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-button" type="button">
                Examination Activities <span class="arrow">▼</span>
            </button>
            <div class="dropdown">
                <a href="{{ route('cbt.examiner.dashboard') }}#examinations">Assigned Examinations</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-button" type="button">
                Account <span class="arrow">▼</span>
            </button>
            <div class="dropdown">
                <form method="POST" action="{{ route('cbt.logout') }}">
                    @csrf
                    <button type="submit" class="logout">Sign Out</button>
                </form>
            </div>
        </div>

    </nav>

    <div class="profile">
        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <span class="profile-name">{{ auth()->user()->name }}</span>
    </div>

</header>

<main class="main">

    <header class="page-header">
        <div>
            <h1>Student Score Management</h1>
            <p>View submitted scripts and manage examination scores.</p>
        </div>
        <span class="access-label">EXAMINER ACCESS</span>
    </header>

    <div class="content">

        <div class="breadcrumb">
            <a href="{{ route('cbt.examiner.dashboard') }}">Dashboard</a>
            <span>›</span>
            <a href="{{ route('cbt.examiner.dashboard') }}#examinations">My Examinations</a>
            <span>›</span>
            <span>Student Scores</span>
        </div>

        <section class="exam-banner">
            <span class="exam-label">EXAMINATION RECORD</span>

            <h2>{{ $examination->title }}</h2>

            <p>
                {{ $examination->subject }} —
                {{ $examination->schoolClass->name ?? 'Class not specified' }}
            </p>

            <div class="exam-meta">
                <div>
                    <small>Academic Year</small>
                    <strong>{{ $examination->academic_year }}</strong>
                </div>

                <div>
                    <small>Term</small>
                    <strong>{{ $examination->term }}</strong>
                </div>

                <div>
                    <small>Examination Mode</small>
                    <strong>{{ ucfirst($examination->mode) }}</strong>
                </div>

                <div>
                    <small>Total Marks</small>
                    <strong>{{ $examination->total_marks }}</strong>
                </div>

                <div>
                    <small>Pass Mark</small>
                    <strong>{{ $examination->pass_mark }}</strong>
                </div>
            </div>
        </section>

        <div class="section-heading">
            <h2>Score Components</h2>
            <p>Maximum marks configured for this examination.</p>
        </div>

        <section class="cards">

            <div class="summary-card">
                <div class="label">Continuous Assessment (CA)</div>
                <h3>{{ $examination->ca_total }}</h3>
                <p>Maximum CA marks</p>
            </div>

            <div class="summary-card">
                <div class="label">Objective Examination</div>
                <h3>{{ $examination->objective_total }}</h3>
                <p>Maximum objective marks</p>
            </div>

            <div class="summary-card">
                <div class="label">Theory Examination</div>
                <h3>{{ $examination->theory_total }}</h3>
                <p>Maximum theory marks</p>
            </div>

        </section>

        <div class="section-heading">
            <h2>Submitted Students</h2>
            <p>Review student submissions and enter outstanding score components.</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <strong>Please check the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="table-card">

            <div class="table-top">
                <div>
                    <h3>Student Examination Records</h3>
                    <p>Submitted attempts for this examination.</p>
                </div>

                <span class="student-count">
                    {{ $attempts->total() }} Submitted
                </span>
            </div>

            @if($attempts->count() > 0)

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Student Details</th>
                                <th>Admission Number</th>
                                <th>Submission Date</th>
                                <th>CA</th>
                                <th>Objective</th>
                                <th>Theory</th>
                                <th>Total Score</th>
                                <th>Result Status</th>
                                <th>Score Entry / Review</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($attempts as $index => $attempt)

                                @php
                                    $student = $attempt->student;
                                    $result = $attempt->result;

                                    $studentName = $student
                                        ? trim(implode(' ', array_filter([
                                            $student->first_name,
                                            $student->other_names,
                                            $student->last_name
                                        ])))
                                        : 'Unknown Student';

                                    $status = $result->status ?? 'awaiting_scores';

                                    $statusClass = match($status) {
                                        'awaiting_scores' => 'status-awaiting',
                                        'pending_review' => 'status-review',
                                        'pending_approval' => 'status-approval',
                                        'approved' => 'status-approved',
                                        'rejected' => 'status-rejected',
                                        default => 'status-other',
                                    };
                                @endphp

                                <tr>
                                    <td>{{ $attempts->firstItem() + $index }}</td>

                                    <td>
                                        <span class="student-name">
                                            {{ $studentName }}
                                        </span>
                                        <span class="student-sub">
                                            Student examination record
                                        </span>
                                    </td>

                                    <td>
                                        {{ $student->admission_number ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $attempt->submitted_at
                                            ? $attempt->submitted_at->format('d M Y, h:i A')
                                            : 'N/A' }}
                                    </td>

                                    <td>
                                        @if($examination->ca_total == 0)
                                            <span class="score-value">N/A</span>
                                        @elseif($result && $result->ca_marks !== null)
                                            <span class="score-value">
                                                {{ $result->ca_marks }}/{{ $examination->ca_total }}
                                            </span>
                                        @else
                                            <span class="score-pending">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($examination->objective_total == 0)
                                            <span class="score-value">N/A</span>
                                        @elseif($result && $result->objective_marks !== null)
                                            <span class="score-value">
                                                {{ $result->objective_marks }}/{{ $examination->objective_total }}
                                            </span>
                                        @else
                                            <span class="score-pending">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($examination->theory_total == 0)
                                            <span class="score-value">N/A</span>
                                        @elseif($result && $result->theory_marks !== null)
                                            <span class="score-value">
                                                {{ $result->theory_marks }}/{{ $examination->theory_total }}
                                            </span>
                                        @else
                                            <span class="score-pending">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($result && $result->status !== 'awaiting_scores')
                                            <span class="score-value">
                                                {{ $result->marks_obtained }}/{{ $result->total_marks }}
                                            </span>
                                        @else
                                            <span class="score-pending">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="status {{ $statusClass }}">
                                            {{ ucwords(str_replace('_', ' ', $status)) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($result && $status === 'awaiting_scores')

                                            <form
                                                class="score-form"
                                                method="POST"
                                                action="{{ route('cbt.examiner.examinations.scores.update', [$examination, $result]) }}"
                                            >
                                                @csrf

                                                @if($examination->ca_total > 0)
                                                    <label>CA Marks (Max: {{ $examination->ca_total }})</label>
                                                    <input
                                                        type="number"
                                                        name="ca_marks"
                                                        min="0"
                                                        max="{{ $examination->ca_total }}"
                                                        step="1"
                                                        value="{{ old('ca_marks', $result->ca_marks) }}"
                                                        placeholder="Enter CA marks"
                                                        required
                                                    >
                                                @endif

                                                @if($examination->mode === 'physical' && $examination->objective_total > 0)
                                                    <label>Objective Marks (Max: {{ $examination->objective_total }})</label>
                                                    <input
                                                        type="number"
                                                        name="objective_marks"
                                                        min="0"
                                                        max="{{ $examination->objective_total }}"
                                                        step="1"
                                                        value="{{ old('objective_marks', $result->objective_marks) }}"
                                                        placeholder="Enter objective marks"
                                                        required
                                                    >
                                                @endif

                                                @if($examination->theory_total > 0)
                                                    <label>Theory Marks (Max: {{ $examination->theory_total }})</label>
                                                    <input
                                                        type="number"
                                                        name="theory_marks"
                                                        min="0"
                                                        max="{{ $examination->theory_total }}"
                                                        step="1"
                                                        value="{{ old('theory_marks', $result->theory_marks) }}"
                                                        placeholder="Enter theory marks"
                                                        required
                                                    >
                                                @endif

                                                <button type="submit" class="save-score">
                                                    Save Scores
                                                </button>
                                            </form>

                                        @elseif($status === 'pending_review' && $result)

                                            <a
                                                href="{{ route('cbt.examiner.examinations.scores.review', [$examination, $result]) }}"
                                                class="review-button"
                                            >
                                                Review Result →
                                            </a>

                                        @elseif($status === 'awaiting_scores')

                                            <span class="locked-note">
                                                Result record is not available for score entry.
                                            </span>

                                        @elseif($status === 'pending_approval')

                                            <span class="locked-note">
                                                Reviewed and submitted.
                                                Awaiting administrator approval.
                                            </span>

                                        @elseif($status === 'approved')

                                            <span class="locked-note">
                                                Result approved.
                                            </span>

                                        @elseif($status === 'rejected')

                                            <span class="locked-note">
                                                Result rejected. Contact the administrator.
                                            </span>

                                        @else

                                            <span class="locked-note">
                                                No score entry available.
                                            </span>

                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $attempts->links() }}
                </div>

            @else

                <div class="empty-state">
                    <div class="icon">📋</div>
                    <h3>No Submitted Students Yet</h3>
                    <p>
                        Student examination submissions will appear here
                        once students complete and submit this examination.
                    </p>
                </div>

            @endif

        </section>

        <div class="notice">
            <strong>Result approval policy:</strong>
            Entering scores does not automatically release results to students.
            All score components must be completed, reviewed and approved by
            the administrator before students can access their results.
            Online objective marks are calculated automatically by the CBT system.
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
