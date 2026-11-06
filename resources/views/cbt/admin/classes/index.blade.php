
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Classes | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #F3F7F8;
            color: #243746;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #173B4D;
            color: #fff;
            padding: 18px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .school-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
        }

        .school-brand h2 {
            margin: 0 0 5px;
            font-size: 18px;
        }

        .school-brand p {
            margin: 0;
            font-size: 12px;
            color: #dce7eb;
        }

        .back-link {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
        }

        .container {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin: 0 0 8px;
            color: #173B4D;
            font-size: 27px;
        }

        .page-heading p {
            margin: 0;
            color: #718096;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border: none;
            border-radius: 6px;
            background: #315C72;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn:hover {
            background: #173B4D;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #fff;
            padding: 22px;
            border: 1px solid #e3eaee;
            border-radius: 9px;
        }

        .stat-card p {
            margin: 0 0 10px;
            color: #718096;
            font-size: 13px;
        }

        .stat-card h2 {
            margin: 0;
            color: #173B4D;
            font-size: 28px;
        }

        .panel {
            background: #fff;
            border: 1px solid #e3eaee;
            border-radius: 9px;
            overflow: hidden;
        }

        .panel-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e3eaee;
        }

        .panel-header h3 {
            margin: 0;
            color: #173B4D;
            font-size: 17px;
        }

        .panel-header p {
            margin: 7px 0 0;
            color: #718096;
            font-size: 13px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #edf1f3;
            font-size: 13px;
        }

        th {
            background: #f8fafb;
            color: #718096;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        td {
            color: #34495e;
        }

        .class-name {
            color: #173B4D;
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .active {
            color: #16805d;
            background: #e8f6f0;
        }

        .inactive {
            color: #bd4141;
            background: #fbeeee;
        }

        .action-link {
            color: #315C72;
            text-decoration: none;
            font-weight: 700;
            margin-right: 12px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .toggle-form {
            display: inline;
        }

        .toggle-button {
            border: none;
            background: none;
            padding: 0;
            color: #bd4141;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .toggle-button.activate {
            color: #16805d;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background: #e8f6f0;
            color: #16805d;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #718096;
        }

        .empty-state h3 {
            color: #173B4D;
            margin-bottom: 8px;
        }

        .pagination {
            padding: 18px 20px;
        }

        @media (max-width: 700px) {
            .topbar {
                padding: 15px 20px;
            }

            .school-brand h2 {
                font-size: 14px;
            }

            .school-brand p {
                font-size: 10px;
            }

            .school-brand img {
                width: 40px;
                height: 40px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="school-brand">
        <img src="{{ asset('images/logo.jpg') }}" alt="School Logo">

        <div>
            <h2>Abu Haneefah Islamic Academy</h2>
            <p>CBT Portal · Administration</p>
        </div>
    </div>

    <a href="{{ route('cbt.admin.dashboard') }}" class="back-link">
        ← Admin Dashboard
    </a>
</header>

<main class="container">

    <div class="page-heading">
        <div>
            <h1>School Class Management</h1>
            <p>Create, organise and manage the school's academic classes.</p>
        </div>

        <a href="{{ route('cbt.admin.classes.create') }}" class="btn">
            + Add New Class
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="stats">

        <div class="stat-card">
            <p>Total Classes</p>
            <h2>{{ $totalClasses }}</h2>
        </div>

        <div class="stat-card">
            <p>Active Classes</p>
            <h2>{{ $activeClasses }}</h2>
        </div>

        <div class="stat-card">
            <p>Inactive Classes</p>
            <h2>{{ $inactiveClasses }}</h2>
        </div>

    </div>

    <section class="panel">

        <div class="panel-header">
            <h3>Registered School Classes</h3>
            <p>Manage class details and their availability for CBT registration.</p>
        </div>

        @if($classes->count())

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Class Name</th>
                            <th>Level</th>
                            <th>Arm</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($classes as $schoolClass)
                            <tr>
                                <td class="class-name">
                                    {{ $schoolClass->name }}
                                </td>

                                <td>
                                    {{ $schoolClass->level }}
                                </td>

                                <td>
                                    {{ $schoolClass->arm ?: '—' }}
                                </td>

                                <td>
                                    {{ $schoolClass->students_count }}
                                </td>

                                <td>
                                    @if($schoolClass->is_active)
                                        <span class="status active">Active</span>
                                    @else
                                        <span class="status inactive">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a
                                        href="{{ route('cbt.admin.classes.edit', $schoolClass) }}"
                                        class="action-link"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('cbt.admin.classes.toggle-status', $schoolClass) }}"
                                        method="POST"
                                        class="toggle-form"
                                        onsubmit="return confirm('Are you sure you want to change this class status?');"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="toggle-button {{ !$schoolClass->is_active ? 'activate' : '' }}"
                                        >
                                            {{ $schoolClass->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $classes->links() }}
            </div>

        @else

            <div class="empty-state">
                <h3>No School Classes Yet</h3>

                <p>
                    Start by adding the school's academic classes.
                    Once created, active classes will become available
                    when registering students and creating examinations.
                </p>

                <a href="{{ route('cbt.admin.classes.create') }}" class="btn">
                    Add First Class
                </a>
            </div>

        @endif

    </section>

</main>

</body>
</html>
