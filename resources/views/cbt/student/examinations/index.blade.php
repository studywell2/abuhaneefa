
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Examinations | Abu Haneefah Islamic Academy</title>

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --background: #F3F7F8;
            --gold: #D6A84F;
            --white: #ffffff;
            --muted: #64748b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: #243746;
        }

        .layout { display: flex; min-height: 100vh; }

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

        .brand h2 { font-size: 17px; margin: 12px 0 5px; }
        .brand p { font-size: 12px; color: #dbe7ec; margin: 0; }

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

        .nav-item:hover { background: var(--blue); }

        .main { flex: 1; min-width: 0; }

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

        .topbar p { color: var(--muted); margin: 0; font-size: 13px; }

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

        .intro {
            margin-bottom: 25px;
        }

        .intro h2 {
            color: var(--navy);
            font-size: 21px;
            margin: 0 0 8px;
        }

        .intro p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .exam-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .exam-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 22px;
            box-shadow: 0 3px 12px #173b4d08;
        }

        .exam-card h3 {
            color: var(--navy);
            font-size: 18px;
            margin: 0 0 7px;
        }

        .subject {
            color: var(--blue);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 17px;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            padding: 16px 0;
            border-top: 1px solid #edf1f4;
            border-bottom: 1px solid #edf1f4;
        }

        .detail-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #243746;
            font-size: 13px;
            font-weight: bold;
        }

        .exam-action {
            display: inline-block;
            margin-top: 18px;
            padding: 11px 16px;
            background: var(--navy);
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .exam-action:hover { background: var(--blue); }

        .empty-state {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 45px 20px;
            text-align: center;
        }

        .empty-state h3 {
            color: var(--navy);
            margin: 0 0 9px;
            font-size: 18px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .pagination {
            margin-top: 25px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 13px;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 4px;
            border-radius: 5px;
            background: white;
            border: 1px solid #e2e8f0;
            color: var(--navy);
            text-decoration: none;
            font-size: 13px;
        }

        .pagination span[aria-current="page"] {
            background: var(--navy);
            color: white;
        }

        footer {
            padding: 20px 30px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 900px) {
            .sidebar { width: 210px; }
            .content { padding: 20px; }
        }

        @media (max-width: 650px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 15px; }

            .brand {
                display: flex;
                align-items: center;
                gap: 12px;
                text-align: left;
                padding-bottom: 15px;
            }

            .brand img { width: 50px; height: 50px; }
            .brand h2 { margin: 0 0 5px; }
            .nav-title { margin-top: 16px; }
            .topbar { padding: 18px; }
            .topbar h1 { font-size: 19px; }
            .exam-grid { grid-template-columns: 1fr; }
            .content { padding: 18px; }
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
                <h1>Available Examinations</h1>
                <p>View examinations assigned to your class.</p>
            </div>

            <form method="POST" action="{{ route('cbt.logout') }}">
                @csrf
                <button type="submit" class="logout">Log Out</button>
            </form>
        </header>

        <div class="content">

            <section class="intro">
                <h2>Your Examinations</h2>
                <p>
                    Review the examination details carefully before proceeding.
                    Only examinations published for your class are displayed here.
                </p>
            </section>

            @forelse ($examinations as $examination)

                <div class="exam-grid">
                    <article class="exam-card">
                        <h3>{{ $examination->title }}</h3>

                        <div class="subject">
                            {{ $examination->subject }}
                        </div>

                        <div class="details">
                            <div>
                                <div class="detail-label">Class</div>
                                <div class="detail-value">
                                    {{ $examination->schoolClass->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div>
                                <div class="detail-label">Academic Year</div>
                                <div class="detail-value">
                                    {{ $examination->academic_year }}
                                </div>
                            </div>

                            <div>
                                <div class="detail-label">Term</div>
                                <div class="detail-value">
                                    {{ $examination->term }}
                                </div>
                            </div>

                            <div>
                                <div class="detail-label">Duration</div>
                                <div class="detail-value">
                                    {{ $examination->duration_minutes }} minutes
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

                        <a href="{{ route('cbt.student.examinations.show', $examination) }}"
                           class="exam-action">
                            View Instructions
                        </a>
                    </article>
                </div>

            @empty

                <div class="empty-state">
                    <h3>No Available Examinations</h3>
                    <p>
                        There are currently no published online examinations
                        available for your class. Please check again later
                        or contact the school examination office.
                    </p>
                </div>

            @endforelse

            <div class="pagination">
                {{ $examinations->links() }}
            </div>

        </div>

        <footer>
            Abu Haneefah Islamic Academy · Computer-Based Testing Portal
        </footer>
    </main>

</div>
</body>
</html>
