<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { margin: 0; background: #f3f7f8; color: #173b4d; font-family: Arial, sans-serif; }
        .topbar { background: #173b4d; color: white; padding: 18px 5%; display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { width: 48px; height: 48px; object-fit: contain; background: white; border-radius: 8px; }
        .brand h1 { font-size: 18px; margin: 0 0 4px; }
        .brand p { font-size: 12px; margin: 0; color: #d6a84f; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .heading { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 22px; }
        .heading h2 { margin: 0 0 7px; font-size: 26px; }
        .muted { color: #64748b; font-size: 14px; }
        .panel { background: white; border-radius: 12px; padding: 22px; box-shadow: 0 3px 15px rgba(23,59,77,.06); margin-bottom: 20px; }
        .search-form { display: flex; gap: 10px; flex-wrap: wrap; }
        .search-form input { flex: 1; min-width: 220px; padding: 11px 12px; border: 1px solid #cbd5e1; border-radius: 7px; font-size: 14px; }
        .btn { display: inline-block; border: 0; border-radius: 7px; padding: 11px 15px; background: #315c72; color: white; text-decoration: none; cursor: pointer; font-size: 14px; }
        .btn-gold { background: #d6a84f; color: #173b4d; font-weight: bold; }
        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 750px; }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: .04em; }
        .status { display: inline-block; padding: 5px 9px; border-radius: 20px; background: #dcfce7; color: #166534; font-size: 12px; }
        .status-inactive { background: #fee2e2; color: #991b1b; }
        .empty { text-align: center; padding: 35px 12px; color: #64748b; }
        .pagination { margin-top: 20px; }
        .back { color: #d6a84f; text-decoration: none; font-weight: bold; }

        .notice { padding: 16px 18px; border-radius: 9px; margin-bottom: 20px; line-height: 1.6; }
        .notice-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
        .notice-error { background: #fff1f2; border: 1px solid #fecdd3; color: #9f1239; }
        .credentials { background: #fffbeb; border: 1px solid #f3d58a; border-radius: 9px; padding: 18px; margin-bottom: 20px; }
        .credentials h3 { margin: 0 0 10px; }
        .credential-row { margin: 9px 0; overflow-wrap: anywhere; }
        .credential-row strong { display: inline-block; min-width: 155px; }
        .warning { font-size: 13px; line-height: 1.6; color: #854d0e; margin-top: 12px; }
        .credentials code { background: #fff; padding: 4px 7px; border-radius: 4px; }
        @media (max-width: 600px) {
            .container { padding: 0 12px; }
            .panel { padding: 15px; }
            .heading h2 { font-size: 22px; }
            .credential-row strong { display: block; margin-bottom: 4px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Academy logo">
            <div>
                <h1>Abu Haneefah Islamic Academy</h1>
                <p>CBT Portal · Administration</p>
            </div>
        </div>

        <a class="back" href="{{ route('cbt.admin.dashboard') }}">
            &larr; Back to Dashboard
        </a>
    </header>

    <main class="container">
        <div class="heading">
            <div>
                <h2>Student Management</h2>
                <div class="muted">Register, view and search student records.</div>
            </div>

            <a class="btn btn-gold" href="{{ route('cbt.admin.students.create') }}">
                + Register New Student
            </a>
        </div>

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

        @if (session('created_student_credentials'))
            @php
                $credentials = session('created_student_credentials');
            @endphp

            <section class="credentials" aria-labelledby="credentials-heading">
                <h3 id="credentials-heading">Student Account Created</h3>

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

                <button
                    type="button"
                    class="btn"
                    onclick="window.print()"
                >
                    Print Account Details
                </button>
            </section>
        @endif

        <section class="panel">
            <form
                class="search-form"
                method="GET"
                action="{{ route('cbt.admin.students.index') }}"
            >
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search admission number, student name or email..."
                    aria-label="Search students"
                >

                <button class="btn" type="submit">Search</button>

                @if (request()->filled('search'))
                    <a class="btn" href="{{ route('cbt.admin.students.index') }}">
                        Clear
                    </a>
                @endif
            </form>
        </section>

        <section class="panel" id="student-list">
            <div class="heading">
                <div>
                    <h2 style="font-size: 19px;">Registered Students</h2>
                    <div class="muted">
                        Showing {{ $students->count() }} of
                        {{ $students->total() }} student records on this page.
                    </div>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Admission Number</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Email / Login</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->admission_number }}</td>

                                <td>
                                    <strong>
                                        {{ $student->last_name }},
                                        {{ $student->first_name }}
                                    </strong>

                                    @if ($student->other_names)
                                        <div class="muted">
                                            {{ $student->other_names }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    {{ $student->schoolClass?->name ?? $student->class_name }}
                                </td>

                                <td>
                                    {{ $student->user?->email ?? 'No login account' }}
                                </td>

                                <td>
                                    @if ($student->is_active)
                                        <span class="status">Active</span>
                                    @else
                                        <span class="status status-inactive">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    No student records found.

                                    @if (request()->filled('search'))
                                        Try another search term or clear the search.
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

            <div class="pagination">
                {{ $students->links() }}
            </div>
        </section>
    </main>
</body>
</html>
