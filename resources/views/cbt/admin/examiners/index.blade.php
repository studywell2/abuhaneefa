<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Examiner Management | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
            --text: #243746;
            --muted: #718096;
            --border: #e3eaee;
            --green: #16805d;
            --red: #bd4141;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 5% 10%, rgba(49, 92, 114, .10), transparent 28%),
                radial-gradient(circle at 95% 90%, rgba(214, 168, 79, .10), transparent 28%),
                var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
            padding-top: 105px;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        /* =========================
           FIXED NAVIGATION BAR
        ========================== */

        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 82px;
            background: var(--navy);
            color: white;
            padding: 12px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            z-index: 1000;
            box-shadow: 0 5px 22px rgba(23, 59, 77, .20);
            border-bottom: 2px solid var(--gold);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 9px;
            padding: 3px;
        }

        .brand h1 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .brand p {
            font-size: 11px;
            color: var(--gold);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
        }

        .nav-link,
        .dropdown-trigger {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 12px 13px;
            color: #e6edf1;
            font-size: 12px;
            font-weight: bold;
            border-radius: 6px;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: .25s ease;
            white-space: nowrap;
        }

        .nav-link:hover,
        .dropdown-trigger:hover,
        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, .10);
            border-color: rgba(255, 255, 255, .12);
        }

        .nav-link.active {
            border-bottom: 2px solid var(--gold);
        }

        .nav-dropdown {
            position: relative;
        }

        .dropdown-arrow {
            font-size: 10px;
            transition: transform .25s ease;
        }

        .nav-dropdown[open] .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 13px);
            left: 0;
            min-width: 215px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 8px;
            box-shadow: 0 12px 35px rgba(23, 59, 77, .18);
            z-index: 1100;
            animation: dropdownEnter .22s ease both;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            font-size: 12px;
            padding: 12px;
            border-radius: 6px;
            transition: .2s ease;
        }

        .dropdown-menu a:hover {
            color: var(--navy);
            background: #edf3f6;
            padding-left: 17px;
        }

        .dropdown-menu .dropdown-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 9px 12px 7px;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 5px 0;
        }

        .user-menu {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 30px;
            color: white;
            padding: 7px 12px 7px 7px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--gold);
            color: var(--navy);
            font-weight: bold;
        }

        .user-menu .dropdown-menu {
            right: 0;
            left: auto;
            min-width: 190px;
        }

        .logout-link {
            width: 100%;
            border: none;
            background: transparent;
            text-align: left;
            cursor: pointer;
            color: var(--red) !important;
        }

        .logout-link:hover {
            background: #fff0ef !important;
        }

        @keyframes dropdownEnter {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================
           PAGE CONTENT
        ========================== */

        .container {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 22px;
            animation: pageEnter .55s ease both;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 25px;
        }

        .heading-text h2 {
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 27px;
        }

        .heading-text p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        /* BUTTONS */

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: var(--blue);
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s ease;
        }

        .btn:hover {
            background: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(23, 59, 77, .16);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--navy);
        }

        .btn-gold:hover {
            background: #c69a3e;
            color: var(--navy);
        }

        .btn-light {
            background: #e9f0f3;
            color: var(--navy);
            border-color: #dce8ed;
        }

        .btn-light:hover {
            background: #dce8ed;
            color: var(--navy);
        }

        .btn-danger {
            background: #fff0ef;
            color: var(--red);
            border-color: #f5d6d4;
        }

        .btn-danger:hover {
            background: var(--red);
            color: white;
        }

        /* =========================
           STATISTICS
        ========================== */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 21px;
            display: flex;
            align-items: center;
            gap: 17px;
            box-shadow: 0 4px 16px rgba(23, 59, 77, .045);
            transition: .3s ease;
            animation: cardEnter .5s ease both;
        }

        .stat-card:nth-child(2) {
            animation-delay: .08s;
        }

        .stat-card:nth-child(3) {
            animation-delay: .16s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
            box-shadow: 0 10px 25px rgba(23, 59, 77, .10);
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            border-radius: 11px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 23px;
        }

        .icon-blue {
            background: #e8f0f4;
        }

        .icon-green {
            background: #e7f5ee;
        }

        .icon-red {
            background: #fff0ef;
        }

        .stat-info p {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 13px;
        }

        .stat-info h3 {
            color: var(--navy);
            font-size: 25px;
        }

        /* NOTICES */

        .notice {
            padding: 16px 19px;
            border-radius: 9px;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 14px;
            animation: pageEnter .35s ease both;
        }

        .notice-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .notice-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #9f1239;
        }

        /* CREDENTIALS */

        .credentials {
            background: #fffbeb;
            border: 1px solid #f3d58a;
            border-left: 5px solid var(--gold);
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 23px;
        }

        .credentials h3 {
            color: var(--navy);
            margin-bottom: 10px;
        }

        .credentials p {
            color: #755a20;
            font-size: 13px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .credential-row {
            margin: 12px 0;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .credential-row strong {
            display: inline-block;
            min-width: 150px;
            color: var(--navy);
        }

        .credentials code {
            background: white;
            border: 1px solid #eee3c7;
            border-radius: 5px;
            padding: 5px 8px;
            color: var(--navy);
        }

        /* PANELS */

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 23px;
            margin-bottom: 22px;
            box-shadow: 0 4px 17px rgba(23, 59, 77, .045);
            transition: .3s ease;
            animation: cardEnter .5s ease both;
        }

        .panel:hover {
            border-color: #d1dfe5;
            box-shadow: 0 8px 25px rgba(23, 59, 77, .075);
        }

        .panel-heading {
            margin-bottom: 17px;
        }

        .panel-heading h3 {
            margin-bottom: 6px;
            color: var(--navy);
            font-size: 17px;
        }

        .panel-heading p {
            color: var(--muted);
            font-size: 12px;
        }

        /* SEARCH */

        .search-form {
            display: flex;
            gap: 11px;
            flex-wrap: wrap;
        }

        .search-form input,
        .search-form select {
            flex: 1;
            min-width: 180px;
            padding: 13px 15px;
            border: 1px solid #d6e0e5;
            border-radius: 8px;
            background: #fbfcfd;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: .25s ease;
        }

        .search-form input:focus,
        .search-form select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(49, 92, 114, .10);
            background: white;
        }

        /* TABLE */

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .table-heading h3 {
            margin-bottom: 6px;
            color: var(--navy);
            font-size: 18px;
        }

        .table-heading p {
            color: var(--muted);
            font-size: 12px;
        }

        .record-count {
            background: #eaf1f4;
            color: var(--blue);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 8px;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        th {
            padding: 15px 13px;
            text-align: left;
            background: #f3f7f8;
            color: #60717c;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        td {
            padding: 16px 13px;
            border-bottom: 1px solid #edf1f3;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr {
            transition: background .2s ease;
        }

        tbody tr:hover {
            background: #f5fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .examiner-name {
            color: var(--navy);
            font-weight: bold;
        }

        /* STATUS */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e5f6ed;
            color: #16734e;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status::before {
            content: "";
            width: 6px;
            height: 6px;
            background: currentColor;
            border-radius: 50%;
        }

        .status-inactive {
            background: #fff0ef;
            color: #b33e3e;
        }

        /* ACTIONS */

        .action-group {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .action-group .btn {
            padding: 8px 11px;
            font-size: 11px;
        }

        .empty {
            text-align: center;
            padding: 45px 15px !important;
            color: var(--muted);
            line-height: 1.7;
        }

        .pagination {
            margin-top: 22px;
        }

        .pagination nav {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        .footer {
            text-align: center;
            color: #89959d;
            font-size: 12px;
            padding: 10px 0 25px;
            line-height: 1.8;
        }

        /* RESPONSIVE NAVIGATION */

        @media (max-width: 1050px) {
            .topbar {
                padding: 12px 3%;
                gap: 10px;
            }

            .brand h1 {
                font-size: 14px;
            }

            .nav-link,
            .dropdown-trigger {
                padding: 10px 8px;
                font-size: 11px;
            }
        }

        @media (max-width: 850px) {
            body {
                padding-top: 145px;
            }

            .topbar {
                min-height: 130px;
                flex-wrap: wrap;
                justify-content: space-between;
                padding: 12px 4%;
            }

            .nav-menu {
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 3px;
            }

            .nav-link,
            .dropdown-trigger {
                flex-shrink: 0;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            body {
                padding-top: 140px;
            }

            .topbar {
                min-height: 125px;
                padding: 10px 14px;
            }

            .brand img {
                width: 40px;
                height: 40px;
            }

            .brand h1 {
                font-size: 13px;
            }

            .brand p {
                font-size: 10px;
            }

            .user-trigger {
                padding: 5px;
            }

            .user-trigger .user-name {
                display: none;
            }

            .nav-menu {
                gap: 3px;
            }

            .nav-link,
            .dropdown-trigger {
                padding: 9px 10px;
                font-size: 10px;
            }

            .dropdown-menu {
                min-width: 195px;
            }

            .container {
                margin: 25px auto;
                padding: 0 13px;
            }

            .heading-text h2 {
                font-size: 23px;
            }

            .page-heading .btn {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .panel {
                padding: 16px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form input,
            .search-form select,
            .search-form .btn {
                width: 100%;
            }

            .credential-row strong {
                display: block;
                margin-bottom: 7px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }

        @media print {

            .topbar,
            .page-heading,
            .stats-grid,
            .panel,
            .footer,
            .notice,
            .credentials .btn {
                display: none !important;
            }

            body {
                background: white;
                padding: 0;
            }
        }
    </style>
</head>

<body>

<!-- <div style="background:red;color:white;padding:20px;text-align:center;font-size:22px;position:relative;z-index:99999;">
    NEW EXAMINER PAGE TEST - NOVEMBER 2026
</div> -->

    <!-- =========================
     FIXED TOP NAVIGATION
========================== -->

    <header class="topbar">

        <div class="brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">

            <div>
                <h1>Abu Haneefah Islamic Academy</h1>
                <p>CBT Portal · Administration</p>
            </div>
        </div>

        <nav class="nav-menu" aria-label="Main navigation">

            <a href="{{ route('cbt.admin.dashboard') }}" class="nav-link">
                <span>⌂</span> Dashboard
            </a>

            <!-- ACADEMIC MANAGEMENT DROPDOWN -->

            <details class="nav-dropdown">
                <summary class="dropdown-trigger">
                    Academic Management
                    <span class="dropdown-arrow">▼</span>
                </summary>

                <div class="dropdown-menu">

                    <span class="dropdown-label">Academic Records</span>

                    <a href="{{ route('cbt.admin.students.index') }}">
                        <span>♙</span> Student Management
                    </a>

                    <a href="{{ route('cbt.admin.examiners.index') }}">
                        <span>♧</span> Examiner Management
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#classes">
                        <span>▦</span> Class Management
                        <small>Coming soon</small>
                    </a>

                </div>
            </details>


            <!-- EXAMINATION DROPDOWN -->

            <details class="nav-dropdown">
                <summary class="dropdown-trigger">
                    Examinations
                    <span class="dropdown-arrow">▼</span>
                </summary>

                <div class="dropdown-menu">

                    <span class="dropdown-label">Examination Centre</span>

                    <a href="#examinations">
                        <span>▤</span> Manage Examinations
                    </a>

                    <a href="#questions">
                        <span>☷</span> Question Bank
                    </a>

                    <a href="#schedules">
                        <span>◷</span> Examination Schedule
                    </a>

                </div>
            </details>


            <!-- RESULTS DROPDOWN -->

            <details class="nav-dropdown">
                <summary class="dropdown-trigger">
                    Results
                    <span class="dropdown-arrow">▼</span>
                </summary>

                <div class="dropdown-menu">

                    <span class="dropdown-label">Result Administration</span>

                    <a href="#results">
                        <span>▥</span> Results Management
                    </a>

                    <a href="#approval">
                        <span>✓</span> Results Approval
                    </a>

                    <a href="#pins">
                        <span>◇</span> Result PIN Management
                    </a>

                </div>
            </details>


            <!-- USER DROPDOWN -->

            <details class="nav-dropdown user-menu">

                <summary class="user-trigger">
                    <span class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>

                    <span class="user-name">
                        {{ auth()->user()->name }}
                    </span>

                    <span class="dropdown-arrow">▼</span>
                </summary>

                <div class="dropdown-menu">

                    <span class="dropdown-label">Administrator Account</span>

                    <a href="{{ route('cbt.admin.dashboard') }}">
                        <span>⌂</span> Dashboard
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('cbt.logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-menu logout-link">
                            ↪ &nbsp; Sign Out
                        </button>
                    </form>

                </div>

            </details>

        </nav>

    </header>


    <!-- =========================
     MAIN CONTENT
========================== -->

    <main class="container">

        <div class="page-heading">

            <div class="heading-text">
                <h2>Examiner Management</h2>

                <p>
                    Register examiners and manage their access to examination
                    and marking responsibilities.
                </p>
            </div>

            <a class="btn btn-gold" href="{{ route('cbt.admin.examiners.create') }}">
                + Register New Examiner
            </a>

        </div>


        <!-- SUCCESS MESSAGE -->

        @if (session('success'))
            <div class="notice notice-success" role="status">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif


        <!-- VALIDATION ERRORS -->

        @if ($errors->any())
            <div class="notice notice-error" role="alert">

                <strong>Please check the following:</strong>

                <ul style="margin: 10px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <!-- NEW EXAMINER CREDENTIALS -->

        @if (session('examiner_credentials'))

            @php
    $credentials = session('examiner_credentials');
            @endphp

            <section class="credentials">

                <h3>Examiner Account Created Successfully</h3>

                <p>
                    Provide these login details privately to the examiner.
                </p>

                <div class="credential-row">
                    <strong>Examiner Name:</strong>
                    {{ $credentials['name'] }}
                </div>

                <div class="credential-row">
                    <strong>Email Address:</strong>
                    <code>{{ $credentials['email'] }}</code>
                </div>

                <div class="credential-row">
                    <strong>Temporary Password:</strong>
                    <code>{{ $credentials['password'] }}</code>
                </div>

                <p>
                    Important: Copy these details and keep them private.
                    The temporary password is displayed only for this
                    registration response.
                </p>

                <button type="button" class="btn" onclick="window.print()">
                    Print Account Details
                </button>

            </section>

        @endif


        <!-- STATISTICS -->

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon icon-blue">
                    &#128101;
                </div>

                <div class="stat-info">
                    <p>Total Matching Examiners</p>
                    <h3>{{ number_format($examiners->total()) }}</h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon icon-green">
                    &#10003;
                </div>

                <div class="stat-info">
                    <p>Active Examiners</p>
                    <h3>{{ number_format($activeExaminers) }}</h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon icon-red">
                    &#9888;
                </div>

                <div class="stat-info">
                    <p>Inactive Examiners</p>
                    <h3>{{ number_format($inactiveExaminers) }}</h3>
                </div>

            </div>

        </section>


        <!-- SEARCH PANEL -->

        <section class="panel">

            <div class="panel-heading">

                <h3>Find an Examiner</h3>

                <p>
                    Search by examiner name or email address and filter by account status.
                </p>

            </div>


            <form class="search-form" method="GET" action="{{ route('cbt.admin.examiners.index') }}">

                <input type="search" name="search" value="{{ request('search') }}"
                    placeholder="Search examiner name or email..." aria-label="Search examiners">

                <select name="status" aria-label="Filter by account status">

                    <option value="">All Account Statuses</option>

                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

                <button class="btn" type="submit">
                    Search
                </button>

                @if (request()->filled('search') || request()->filled('status'))

                    <a class="btn btn-light" href="{{ route('cbt.admin.examiners.index') }}">
                        Clear
                    </a>

                @endif

            </form>

        </section>


        <!-- EXAMINER TABLE -->

        <section class="panel">

            <div class="table-heading">

                <div>
                    <h3>Registered Examiners</h3>

                    <p>
                        Review examiner accounts and manage their access.
                    </p>
                </div>

                <span class="record-count">
                    {{ $examiners->count() }} records on this page
                </span>

            </div>


            <div class="table-wrap">

                <table>

                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Examiner Name</th>
                            <th>Email Address</th>
                            <th>Account Status</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($examiners as $examiner)

                            <tr>

                                <td>
                                    {{ $examiners->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="examiner-name">
                                        {{ $examiner->name }}
                                    </div>
                                </td>

                                <td>
                                    {{ $examiner->email }}
                                </td>

                                <td>

                                    @if ($examiner->is_active)

                                        <span class="status">
                                            Active
                                        </span>

                                    @else

                                        <span class="status status-inactive">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $examiner->created_at?->format('d M Y') }}
                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="{{ route('cbt.admin.examiners.show', $examiner) }}" class="btn">
                                            View
                                        </a>

                                        <a href="{{ route('cbt.admin.examiners.edit', $examiner) }}" class="btn btn-gold">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('cbt.admin.examiners.toggle-status', $examiner) }}">

                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn btn-light">
                                                {{ $examiner->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>

                                        </form>


                                        <form method="POST" action="{{ route('cbt.admin.examiners.destroy', $examiner) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this examiner account? This action cannot be undone.')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="empty">

                                    <strong>No examiner accounts found.</strong>

                                    <br>

                                    @if (request()->filled('search') || request()->filled('status'))

                                        Try changing your search or filter.

                                    @else

                                        Examiner accounts will appear here after registration.

                                    @endif

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="pagination">
                {{ $examiners->withQueryString()->links() }}
            </div>

        </section>


        <!-- FOOTER -->

        <footer class="footer">

            Abu Haneefah Islamic Academy &copy; {{ date('Y') }}

            <br>

            CBT Administration Portal

        </footer>

    </main>


    <!-- =========================
     DROPDOWN INTERACTION
========================== -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const dropdowns = document.querySelectorAll('.nav-dropdown');

            // Close other dropdowns when one is opened.
            dropdowns.forEach(function (dropdown) {

                dropdown.addEventListener('toggle', function () {

                    if (dropdown.open) {

                        dropdowns.forEach(function (otherDropdown) {

                            if (otherDropdown !== dropdown) {
                                otherDropdown.removeAttribute('open');
                            }

                        });

                    }

                });

            });


            // Close dropdowns when clicking outside the navigation.
            document.addEventListener('click', function (event) {

                dropdowns.forEach(function (dropdown) {

                    if (!dropdown.contains(event.target)) {
                        dropdown.removeAttribute('open');
                    }

                });

            });


            // Close dropdowns when Escape is pressed.
            document.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {

                    dropdowns.forEach(function (dropdown) {
                        dropdown.removeAttribute('open');
                    });

                }

            });

        });
    </script>

</body>

</html>