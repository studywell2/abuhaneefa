
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
            --white: #ffffff;
            --text: #243746;
            --muted: #718096;
            --border: #e3eaee;
            --green: #16805d;
            --red: #bd4141;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 5% 10%, rgba(49, 92, 114, .10), transparent 28%),
                radial-gradient(circle at 95% 90%, rgba(214, 168, 79, .10), transparent 28%),
                var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* Top navigation */

        .topbar {
            min-height: 82px;
            background: var(--navy);
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            box-shadow: 0 4px 15px rgba(23, 59, 77, .12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand img {
            width: 49px;
            height: 49px;
            object-fit: contain;
            background: white;
            border-radius: 9px;
            padding: 3px;
        }

        .brand h1 {
            font-size: 18px;
            margin: 0 0 5px;
        }

        .brand p {
            font-size: 12px;
            margin: 0;
            color: var(--gold);
            letter-spacing: .4px;
        }

        .back-link {
            color: #f2dcae;
            font-size: 13px;
            font-weight: bold;
            transition: .3s;
        }

        .back-link:hover {
            color: white;
            transform: translateX(-3px);
        }

        /* Main container */

        .container {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 22px;
            animation: fadeUp .7s ease;
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
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 27px;
        }

        .heading-text p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Buttons */

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px 17px;
            border: none;
            border-radius: 8px;
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
            box-shadow: 0 6px 14px rgba(23, 59, 77, .15);
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
        }

        .btn-light:hover {
            background: #dce8ed;
            color: var(--navy);
        }

        /* Statistics */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 21px;
            display: flex;
            align-items: center;
            gap: 17px;
            box-shadow: 0 4px 16px rgba(23, 59, 77, .045);
            transition: .3s ease;
            animation: fadeUp .6s ease both;
        }

        .stat-card:nth-child(2) {
            animation-delay: .1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: .2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 9px 22px rgba(23, 59, 77, .09);
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
            margin: 0 0 7px;
            color: var(--muted);
            font-size: 13px;
        }

        .stat-info h3 {
            margin: 0;
            color: var(--navy);
            font-size: 25px;
        }

        .stat-info small {
            display: block;
            margin-top: 5px;
            color: #98a4ad;
            font-size: 11px;
        }

        /* Notifications */

        .notice {
            padding: 16px 19px;
            border-radius: 9px;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 14px;
            animation: fadeUp .4s ease;
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

        /* Credentials */

        .credentials {
            background: #fffbeb;
            border: 1px solid #f3d58a;
            border-left: 5px solid var(--gold);
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 23px;
            animation: fadeUp .5s ease;
        }

        .credentials h3 {
            color: var(--navy);
            margin: 0 0 10px;
            font-size: 18px;
        }

        .credentials p {
            color: #755a20;
            font-size: 13px;
            line-height: 1.6;
        }

        .credential-row {
            margin: 12px 0;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .credential-row strong {
            display: inline-block;
            min-width: 160px;
            color: var(--navy);
        }

        .credentials code {
            background: white;
            border: 1px solid #eee3c7;
            border-radius: 5px;
            padding: 5px 8px;
            color: var(--navy);
        }

        .warning {
            font-size: 12px !important;
            margin: 15px 0;
        }

        /* Main panels */

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 23px;
            margin-bottom: 22px;
            box-shadow: 0 4px 17px rgba(23, 59, 77, .045);
        }

        /* Bulk student import */

        .import-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: stretch;
        }

        .import-card {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            background: #fbfcfd;
        }

        .import-card h3 {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 16px;
        }

        .import-card p,
        .import-help {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.65;
        }

        .import-card input[type="file"] {
            display: block;
            width: 100%;
            margin: 15px 0;
            padding: 12px;
            border: 1px dashed #b9c9d1;
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-size: 13px;
        }

        .import-help {
            margin: 12px 0 0;
            font-size: 12px;
        }

        /* Search and filters */

        .search-heading {
            margin-bottom: 17px;
        }

        .search-heading h3 {
            margin: 0 0 6px;
            color: var(--navy);
            font-size: 17px;
        }

        .search-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .search-form {
            display: flex;
            gap: 11px;
            flex-wrap: wrap;
        }

        .search-form input,
        .search-form select {
            flex: 1;
            min-width: 190px;
            padding: 13px 15px;
            border: 1px solid #d6e0e5;
            border-radius: 8px;
            background: #fbfcfd;
            color: var(--text);
            font-size: 13px;
            transition: .3s;
        }

        .search-form input:focus,
        .search-form select:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(49, 92, 114, .10);
        }

        /* Table heading */

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .table-heading h3 {
            margin: 0 0 6px;
            color: var(--navy);
            font-size: 18px;
        }

        .table-heading p {
            margin: 0;
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

        /* Student table */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(23, 59, 77, .05);
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            padding: 15px 14px;
            text-align: left;
            background: #f1f6f8;
            color: #536575;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 15px 14px;
            border-bottom: 1px solid #edf1f3;
            font-size: 13px;
            vertical-align: middle;
            color: #354653;
        }

        tbody tr {
            transition: background .2s ease;
        }

        tbody tr:hover {
            background: #f6fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .student-name {
            color: var(--navy);
            font-weight: bold;
        }

        .student-other-name {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .admission-number {
            display: inline-block;
            background: #edf3f6;
            color: var(--blue);
            padding: 6px 9px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .class-label {
            display: inline-block;
            background: #f8f2e5;
            color: #88651e;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .department-label {
            display: inline-block;
            background: #e8f0f4;
            color: var(--blue);
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

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

        .empty {
            text-align: center;
            padding: 45px 15px !important;
            color: var(--muted);
            line-height: 1.7;
        }

        .empty-icon {
            font-size: 32px;
            display: block;
            margin-bottom: 10px;
        }

        /* Pagination */

        .pagination {
            margin-top: 22px;
        }

        .pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        /* Footer */

        .footer {
            text-align: center;
            color: #89959d;
            font-size: 12px;
            padding: 10px 0 25px;
        }

        /* Animations */

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */

        @media (max-width: 850px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 15px 18px;
            }

            .brand h1 {
                font-size: 15px;
            }

            .brand img {
                width: 43px;
                height: 43px;
            }

            .container {
                margin: 25px auto;
                padding: 0 13px;
            }

            .heading-text h2 {
                font-size: 23px;
            }

            .page-heading {
                align-items: flex-start;
            }

            .page-heading .btn {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }

            .panel {
                padding: 16px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form input,
            .search-form select {
                min-width: 100%;
            }

            .search-form .btn {
                width: 100%;
            }

            .credential-row strong {
                display: block;
                margin-bottom: 7px;
            }

            .import-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Printing credentials */

        @media print {
            body {
                background: white;
            }

            .topbar,
            .container > .page-heading,
            .stats-grid,
            .notice,
            .panel,
            .footer,
            .credentials .btn {
                display: none !important;
            }

            .container {
                margin: 30px auto;
            }

            .credentials {
                display: block !important;
                border: 1px solid #ccc;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    {{-- HEADER --}}

    <header class="topbar">

        <div class="brand">

            <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">

            <div>
                <h1>Abu Haneefah Islamic Academy</h1>
                <p>CBT Portal · Administration</p>
            </div>

        </div>

        <a class="back-link" href="{{ route('cbt.admin.dashboard') }}">
            &larr; Back to Dashboard
        </a>

    </header>

    <main class="container">

        {{-- PAGE HEADING --}}

        <div class="page-heading">

            <div class="heading-text">
                <h2>Student Management</h2>

                <p>
                    Manage student registrations, academic records and accounts.
                </p>
            </div>

            <a class="btn btn-gold" href="{{ route('cbt.admin.students.create') }}">
                <span>+</span>
                Register New Student
            </a>

        </div>

        {{-- NOTIFICATIONS --}}

        @if (session('success'))

            <div class="notice notice-success" role="status">
                <strong>{{ session('success') }}</strong>
            </div>

        @endif

        @if ($errors->any())

            <div class="notice notice-error" role="alert">

                <strong>Please check the following:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        {{-- STUDENT CREDENTIALS --}}

        @if (session('created_student_credentials'))

            @php
                $credentials = session('created_student_credentials');
            @endphp

            <section class="credentials" aria-labelledby="credentials-heading">

                <h3 id="credentials-heading">
                    Student Account Created Successfully
                </h3>

                <p>
                    The student account has been created successfully.
                    Provide these login details privately to the student.
                </p>

                <div class="credential-row">
                    <strong>Student Name:</strong>
                    {{ $credentials['name'] }}
                </div>

                <div class="credential-row">
                    <strong>Admission Number:</strong>
                    <code>{{ $credentials['admission_number'] }}</code>
                </div>

                <div class="credential-row">
                    <strong>Email Address:</strong>
                    <code>{{ $credentials['email'] }}</code>
                </div>

                <div class="credential-row">
                    <strong>Temporary Password:</strong>
                    <code>{{ $credentials['temporary_password'] }}</code>
                </div>

                <p class="warning">
                    Important: Copy these details and keep them private.
                    The temporary password is shown only for this successful
                    registration response. Do not share it publicly.
                </p>

                <button type="button" class="btn" onclick="window.print()">
                    Print Account Details
                </button>

            </section>

        @endif

        {{-- STATISTICS --}}

        @php
            $pageStudents = $students->getCollection();

            $totalStudents = $students->total();

            $activeStudents = $pageStudents->where('is_active', true)->count();

            $inactiveStudents = $pageStudents->where('is_active', false)->count();
        @endphp

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon icon-blue">
                    &#128101;
                </div>

                <div class="stat-info">
                    <p>Total Matching Students</p>
                    <h3>{{ number_format($totalStudents) }}</h3>
                    <small>Records matching your current search</small>
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-icon icon-green">
                    &#10003;
                </div>

                <div class="stat-info">
                    <p>Active Students</p>
                    <h3>{{ number_format($activeStudents) }}</h3>
                    <small>Active students on this page</small>
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-icon icon-red">
                    &#9888;
                </div>

                <div class="stat-info">
                    <p>Inactive Students</p>
                    <h3>{{ number_format($inactiveStudents) }}</h3>
                    <small>Inactive students on this page</small>
                </div>

            </div>

        </section>

        {{-- BULK STUDENT IMPORT --}}

        <section class="panel" aria-labelledby="bulk-import-heading">

            <div class="search-heading">
                <h3 id="bulk-import-heading">Bulk Student Registration</h3>

                <p>
                    Register multiple students at once using an Excel or CSV class list.
                </p>
            </div>

            <div class="import-grid">

                <div class="import-card">

                    <h3>1. Download the Template</h3>

                    <p>
                        Download the official template and enter each student's details under the correct column heading.
                        Do not rename or remove the headings.
                    </p>

                    <a class="btn btn-light"
                       href="{{ route('cbt.admin.students.import.template') }}">
                        Download Excel/CSV Template
                    </a>

                </div>

                <div class="import-card">

                    <h3>2. Upload Completed Class List</h3>

                    <p>
                        Choose the completed template file. Supported formats are Excel (.xlsx, .xls) and CSV (.csv).
                    </p>

                    <form method="POST"
                          action="{{ route('cbt.admin.students.import') }}"
                          enctype="multipart/form-data">

                        @csrf

                        <input
                            type="file"
                            name="students_file"
                            accept=".xlsx,.xls,.csv"
                            required
                            aria-label="Select student Excel or CSV file"
                        >

                        <button class="btn btn-gold" type="submit">
                            Import Students
                        </button>

                    </form>

                    <p class="import-help">
                        Please check the class names and email addresses before uploading.
                        Duplicate email addresses and invalid records must be corrected before they can be registered.
                    </p>

                </div>

            </div>

        </section>

        {{-- SEARCH AND FILTER SECTION --}}

        <section class="panel">

            <div class="search-heading">

                <h3>Find a Student</h3>

                <p>
                    Search by name, admission number or email. You can also filter by class and department.
                </p>

            </div>

            <form class="search-form"
                  method="GET"
                  action="{{ route('cbt.admin.students.index') }}">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search admission number, name or email..."
                    aria-label="Search students"
                >

                <select name="school_class_id" aria-label="Filter by class">

                    <option value="">All Classes</option>

                    @foreach ($classes as $class)

                        <option value="{{ $class->id }}"
                            @selected(request('school_class_id') == $class->id)>
                            {{ $class->name }}
                        </option>

                    @endforeach

                </select>

                <select name="department" aria-label="Filter by department">

                    <option value="">All Departments</option>

                    @foreach ($departments as $department)

                        <option value="{{ $department }}"
                            @selected(request('department') === $department)>
                            {{ $department }}
                        </option>

                    @endforeach

                </select>

                <button class="btn" type="submit">
                    Apply Filters
                </button>

                @if (request()->hasAny(['search', 'school_class_id', 'department']))

                    <a class="btn btn-light"
                       href="{{ route('cbt.admin.students.index') }}">
                        Clear Filters
                    </a>

                @endif

            </form>

        </section>

        {{-- STUDENT RECORDS --}}

        <section class="panel" id="student-list">

            <div class="table-heading">

                <div>
                    <h3>Registered Students</h3>

                    <p>
                        Manage and review student records.
                    </p>
                </div>

                <span class="record-count">
                    {{ $students->count() }} records on this page
                </span>

            </div>

            <div class="table-wrap">

                <table>

                    <thead>

                        <tr>
                            <th>Admission Number</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Department</th>
                            <th>Email / Login</th>
                            <th>Account Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($students as $student)

                            <tr>

                                <td>
                                    <span class="admission-number">
                                        {{ $student->admission_number }}
                                    </span>
                                </td>

                                <td>

                                    <div class="student-name">
                                        {{ $student->last_name }},
                                        {{ $student->first_name }}
                                    </div>

                                    @if ($student->other_names)

                                        <div class="student-other-name">
                                            {{ $student->other_names }}
                                        </div>

                                    @endif

                                </td>

                                <td>

                                    <span class="class-label">
                                        {{ $student->schoolClass?->name ?? $student->class_name }}
                                    </span>

                                </td>

                                <td>

                                    @if ($student->department)

                                        <span class="department-label">
                                            {{ $student->department }}
                                        </span>

                                    @else

                                        <span style="color:#98a4ad;">
                                            Not applicable
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $student->user?->email ?? 'No login account' }}
                                </td>

                                <td>

                                    @if ($student->is_active)

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

                                    <div style="display:flex; gap:8px; flex-wrap:wrap;">

                                        <a href="{{ route('cbt.admin.students.show', $student) }}"
                                           class="btn"
                                           style="padding:8px 12px; font-size:12px;">
                                            View
                                        </a>

                                        <a href="{{ route('cbt.admin.students.edit', $student) }}"
                                           class="btn btn-gold"
                                           style="padding:8px 12px; font-size:12px;">
                                            Edit
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="empty">

                                    <span class="empty-icon">
                                        &#128269;
                                    </span>

                                    <strong>No student records found.</strong>

                                    <br>

                                    @if (request()->hasAny(['search', 'school_class_id', 'department']))

                                        Try changing your search or filters.

                                    @else

                                        Student records will appear here after
                                        the administrator registers students.

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}

            <div class="pagination">
                {{ $students->withQueryString()->links() }}
            </div>

        </section>

        <footer class="footer">

            Abu Haneefah Islamic Academy &copy; {{ date('Y') }}

            <br>

            CBT Administration Portal

        </footer>

    </main>

</body>

</html>
