<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Results | Abu Haneefah Islamic Academy</title>

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

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h2 {
            color: var(--navy);
            margin: 0 0 8px;
            font-size: 23px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .period-card {
            background: linear-gradient(120deg, var(--navy), var(--blue));
            color: white;
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 20px;
            border-bottom: 4px solid var(--gold);
        }

        .period-card h3 {
            font-size: 16px;
            margin: 0 0 10px;
        }

        .period-card p {
            color: #e3edf1;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .consolidated-action {
            margin-bottom: 25px;
        }

        .result-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 3px 12px #173b4d08;
        }

        .result-header {
            background: #f8fafc;
            padding: 18px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .result-header h3 {
            color: var(--navy);
            font-size: 16px;
            margin: 0 0 6px;
        }

        .result-header p {
            color: var(--muted);
            font-size: 12px;
            margin: 0;
        }

        .outcome {
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .passed {
            background: #dcfce7;
            color: #166534;
        }

        .failed {
            background: #fee2e2;
            color: #991b1b;
        }

        .score-section {
            padding: 22px;
        }

        .score-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .score-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 17px;
        }

        .score-box span {
            display: block;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 9px;
        }

        .score-box strong {
            color: var(--navy);
            font-size: 19px;
        }

        .final-score {
            margin-top: 18px;
            padding: 20px;
            background: #eaf1f4;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .final-score p {
            color: var(--muted);
            font-size: 12px;
            margin: 0 0 5px;
        }

        .final-score h3 {
            color: var(--navy);
            font-size: 25px;
            margin: 0;
        }

        .percentage {
            color: var(--blue);
            font-size: 22px;
            font-weight: bold;
        }

        .individual-print {
            margin-top: 18px;
            text-align: right;
        }

        .approved-note {
            padding: 13px 22px;
            border-top: 1px solid #e2e8f0;
            color: #166534;
            font-size: 12px;
            background: #f0fdf4;
        }

        .empty-state {
            background: white;
            padding: 45px 25px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .empty-state .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 18px;
            margin: 0 0 10px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            max-width: 500px;
            margin: auto;
        }

        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .action-button {
            display: inline-block;
            background: var(--navy);
            color: white;
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 7px;
            font-size: 12px;
            border: none;
            cursor: pointer;
        }

        .action-button:hover {
            background: var(--blue);
            color: white;
        }

        .secondary-button {
            background: white;
            color: var(--navy);
            border: 1px solid #cbd5e1;
        }

        .secondary-button:hover {
            background: #f1f5f9;
            color: var(--navy);
        }

        footer {
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 900px) {
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

            .content {
                padding: 18px;
            }

            .score-grid {
                grid-template-columns: 1fr;
            }

            .result-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .final-score {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media print {
            .sidebar,
            .topbar,
            .action-row,
            .consolidated-action,
            .individual-print,
            footer {
                display: none !important;
            }

            .layout {
                display: block;
            }

            .content {
                max-width: none;
                padding: 0;
            }

            body {
                background: white;
            }

            .result-card {
                break-inside: avoid;
                box-shadow: none;
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

        <a href="{{ route('cbt.student.results.index') }}" class="nav-item active">
            My Results
        </a>

        <a href="{{ route('cbt.student.results.pin') }}" class="nav-item">
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
                <h1>My Examination Results</h1>
                <p>View your approved examination performance.</p>
            </div>

            <form method="POST" action="{{ route('cbt.logout') }}">
                @csrf

                <button type="submit" class="logout">
                    Log Out
                </button>
            </form>

        </header>

        <div class="content">

            <div class="page-heading">

                <h2>My Results</h2>

                <p>
                    These are your approved examination results covered
                    by your validated Result PIN.
                </p>

            </div>

            <section class="period-card">

                <h3>Result PIN Validity Period</h3>

                <p>
                    Your PIN covers
                    {{ $resultPin->start_term }}
                    ({{ $resultPin->start_academic_year }})
                    and
                    {{ $resultPin->end_term }}
                    ({{ $resultPin->end_academic_year }}).
                </p>

            </section>

            <div class="consolidated-action">

                <a href="{{ route('cbt.student.results.consolidated') }}"
                   class="action-button">
                    Print Consolidated Result Sheet
                </a>

            </div>

            @if ($results->isNotEmpty())

                @foreach ($results as $result)

                    @php
                        $examination = $result->attempt->examination;
                    @endphp

                    <article class="result-card">

                        <div class="result-header">

                            <div>
                                <h3>{{ $examination->title }}</h3>

                                <p>
                                    {{ $examination->subject }}
                                    &nbsp;|&nbsp;
                                    {{ $examination->academic_year }}
                                    &nbsp;|&nbsp;
                                    {{ $examination->term }} Term
                                </p>
                            </div>

                            <span class="outcome {{ strtolower($result->outcome) === 'passed' ? 'passed' : 'failed' }}">
                                {{ ucfirst($result->outcome) }}
                            </span>

                        </div>

                        <div class="score-section">

                            <div class="score-grid">

                                <div class="score-box">
                                    <span>Continuous Assessment (CA)</span>

                                    <strong>
                                        {{ $result->ca_marks ?? 0 }}
                                        /
                                        {{ $examination->ca_total }}
                                    </strong>
                                </div>

                                <div class="score-box">
                                    <span>Objective</span>

                                    <strong>
                                        {{ $result->objective_marks ?? 0 }}
                                        /
                                        {{ $examination->objective_total }}
                                    </strong>
                                </div>

                                <div class="score-box">
                                    <span>Theory</span>

                                    <strong>
                                        {{ $result->theory_marks ?? 0 }}
                                        /
                                        {{ $examination->theory_total }}
                                    </strong>
                                </div>

                            </div>

                            <div class="final-score">

                                <div>
                                    <p>Final Examination Score</p>

                                    <h3>
                                        {{ $result->marks_obtained }}
                                        /
                                        {{ $result->total_marks }}
                                    </h3>
                                </div>

                                <div class="percentage">
                                    {{ number_format((float) $result->percentage, 2) }}%
                                </div>

                            </div>

                            <div class="individual-print">

                                <a href="{{ route('cbt.student.results.print', $result->id) }}"
                                   class="action-button">
                                    Print Individual Result Slip
                                </a>

                            </div>

                        </div>

                        <div class="approved-note">
                            ✓ This result has been approved by the school administrator.
                        </div>

                    </article>

                @endforeach

            @else

                <section class="empty-state">

                    <div class="icon">📊</div>

                    <h3>No Approved Results Available</h3>

                    <p>
                        There are currently no approved examination results
                        available within the academic periods covered by
                        your Result PIN. Please check again when the school
                        administrator releases your results.
                    </p>

                </section>

            @endif

            <div class="action-row">

                <a href="{{ route('cbt.student.dashboard') }}"
                   class="action-button secondary-button">
                    Back to Dashboard
                </a>

                <div style="display:flex;gap:10px;flex-wrap:wrap;">

                    <button type="button"
                            onclick="window.print()"
                            class="action-button">
                        Print Results
                    </button>

                    <form method="POST"
                          action="{{ route('cbt.student.results.logout-pin') }}">

                        @csrf

                        <button type="submit"
                                class="action-button secondary-button">
                            Lock Results
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <footer>
            Abu Haneefah Islamic Academy · Computer-Based  Portal
        </footer>

    </main>

</div>

</body>
</html>