<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Instructions | Abu Haneefah Islamic Academy</title>

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

        .nav-item.active {
            background: var(--blue);
            border-left: 4px solid var(--gold);
        }

        .nav-item:hover {
            background: var(--blue);
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
            max-width: 1100px;
            margin: auto;
        }

        .exam-heading {
            background: linear-gradient(120deg, var(--navy), var(--blue));
            color: white;
            border-radius: 10px;
            padding: 25px;
            border-bottom: 4px solid var(--gold);
            margin-bottom: 22px;
        }

        .exam-heading h2 {
            font-size: 23px;
            margin: 0 0 8px;
        }

        .exam-heading p {
            color: #e3edf1;
            font-size: 14px;
            margin: 0;
        }

        .details-card,
        .instructions-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 23px;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--navy);
            font-size: 17px;
            margin: 0 0 18px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .detail-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 6px;
        }

        .detail-value {
            color: #243746;
            font-size: 14px;
            font-weight: bold;
        }

        .instructions {
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
            white-space: pre-line;
        }

        .default-instructions {
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
        }

        .default-instructions li {
            margin-bottom: 9px;
        }

        .warning {
            background: #fff8e8;
            border: 1px solid #f2dfb3;
            border-left: 4px solid var(--gold);
            border-radius: 8px;
            padding: 17px;
            margin-bottom: 22px;
        }

        .warning h3 {
            color: #805b12;
            font-size: 14px;
            margin: 0 0 7px;
        }

        .warning p {
            color: #795f2b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .back-button,
        .start-button {
            display: inline-block;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .back-button {
            color: var(--navy);
            background: white;
            border: 1px solid #cbd5e1;
        }

        .start-button {
            background: var(--navy);
            color: white;
            border: 0;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .start-button:hover {
            background: var(--blue);
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

            .content {
                padding: 20px;
            }

            .details-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .details-grid {
                grid-template-columns: 1fr 1fr;
            }

            .exam-heading h2 {
                font-size: 20px;
            }

            .actions {
                align-items: stretch;
                flex-direction: column;
            }

            .actions a {
                text-align: center;
            }

            .actions form {
                width: 100%;
            }

            .actions button {
                width: 100%;
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

            <a href="{{ route('cbt.student.examinations.index') }}" class="nav-item active">
                Available Examinations
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
                    <h1>Examination Instructions</h1>
                    <p>Review the details before beginning your examination.</p>
                </div>

                <form method="POST" action="{{ route('cbt.logout') }}">
                    @csrf
                    <button type="submit" class="logout">Log Out</button>
                </form>
            </header>

            <div class="content">

                <section class="exam-heading">
                    <h2>{{ $examination->title }}</h2>
                    <p>{{ $examination->subject }} · {{ $examination->academic_year }} · {{ $examination->term }} Term
                    </p>
                </section>

                <section class="details-card">
                    <h3 class="section-title">Examination Details</h3>

                    <div class="details-grid">

                        <div>
                            <div class="detail-label">Class</div>
                            <div class="detail-value">
                                {{ $examination->schoolClass->name ?? 'N/A' }}
                            </div>
                        </div>

                        <div>
                            <div class="detail-label">Duration</div>
                            <div class="detail-value">
                                {{ $examination->duration_minutes }} Minutes
                            </div>
                        </div>

                        <div>
                            <div class="detail-label">Total Marks</div>
                            <div class="detail-value">
                                {{ $examination->total_marks }}
                            </div>
                        </div>

                        <div>
                            <div class="detail-label">Pass Mark</div>
                            <div class="detail-value">
                                {{ $examination->pass_mark }}
                            </div>
                        </div>

                        <div>
                            <div class="detail-label">Start Time</div>
                            <div class="detail-value">
                                {{ $examination->start_time?->format('d M Y, h:i A') ?? 'Not set' }}
                            </div>
                        </div>

                        <div>
                            <div class="detail-label">End Time</div>
                            <div class="detail-value">
                                {{ $examination->end_time?->format('d M Y, h:i A') ?? 'Not set' }}
                            </div>
                        </div>

                    </div>
                </section>

                <section class="instructions-card">
                    <h3 class="section-title">Instructions to Candidates</h3>

                    @if ($examination->instructions)

                        <div class="instructions">{{ $examination->instructions }}</div>

                    @else

                        <ol class="default-instructions">
                            <li>Read every question carefully before selecting an answer.</li>
                            <li>Choose the most appropriate answer for each question.</li>
                            <li>Monitor your examination time throughout the test.</li>
                            <li>Ensure you submit your answers before the examination time expires.</li>
                            <li>Do not refresh or close your browser while an examination is in progress.</li>
                            <li>Contact the examination supervisor if you experience a technical problem.</li>
                        </ol>

                    @endif
                </section>

                <section class="warning">
                    <h3>Important Notice</h3>
                    <p>
                        Once you start an examination, the examination timer will begin.
                        Ensure you are ready before proceeding. Your answers will be
                        submitted when you finish or when the examination time expires.
                    </p>
                </section>

                <div class="actions">

                    <a href="{{ route('cbt.student.examinations.index') }}" class="back-button">
                        Back to Examinations
                    </a>

                    <form method="POST" action="{{ route('cbt.student.examinations.start', $examination) }}">
                        @csrf

                        <button type="submit" class="start-button">
                            Start Examination
                        </button>
                    </form>

                </div>

            </div>

            <footer>
                Abu Haneefah Islamic Academy · Computer-Based  Portal
            </footer>

        </main>

    </div>
</body>

</html>