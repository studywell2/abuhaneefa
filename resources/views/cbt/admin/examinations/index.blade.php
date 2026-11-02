
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Management | Abuhaneefah Islamic Academy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #173B4D;
            --navy-light: #315C72;
            --gold: #D6A84F;
            --page: #f4f6f8;
            --border: #e5e9ed;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--page);
            color: #273444;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .topbar {
            min-height: 66px;
            background: var(--navy);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .brand {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .brand small {
            display: block;
            color: #c8d5dc;
            font-size: 11px;
            font-weight: 400;
            margin-top: 3px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .topbar a {
            color: white;
            text-decoration: none;
        }

        .topbar a:hover {
            color: var(--gold);
        }

        .page-wrapper {
            padding: 30px;
            max-width: 1500px;
            margin: auto;
        }

        .breadcrumb {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .breadcrumb a {
            color: var(--navy-light);
            text-decoration: none;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 23px;
            font-weight: 700;
            color: var(--navy);
            margin: 0 0 6px;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .btn-primary-custom {
            background: var(--navy);
            color: white;
            border: 1px solid var(--navy);
            padding: 10px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            background: var(--navy-light);
            color: white;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .summary-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: 5px;
            padding: 18px 20px;
        }

        .summary-item .label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 10px;
        }

        .summary-item .number {
            font-size: 25px;
            font-weight: 700;
            color: var(--navy);
        }

        .summary-item .description {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .section-panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 5px;
            margin-bottom: 22px;
        }

        .panel-heading {
            padding: 17px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-heading h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            margin: 0;
        }

        .table {
            margin: 0;
            white-space: nowrap;
        }

        .table thead th {
            background: #f8fafb;
            color: #596579;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
            padding: 13px 15px;
            border-bottom: 1px solid var(--border);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            font-size: 13px;
            border-color: #edf0f2;
        }

        .exam-title {
            color: var(--navy);
            font-weight: 700;
        }

        .muted-text {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-draft {
            background: #f1f3f5;
            color: #596579;
        }

        .status-published {
            background: #e5f2eb;
            color: #26734d;
        }

        .status-completed {
            background: #e8eef7;
            color: #345a86;
        }

        .status-other {
            background: #fff3dc;
            color: #8a641b;
        }

        .empty-state {
            text-align: center;
            padding: 55px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 35px;
            color: #aab4bd;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state h6 {
            color: var(--navy);
            font-weight: 700;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            color: var(--navy);
            font-size: 12px;
        }

        .pagination .active .page-link {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
        }

        .footer {
            color: var(--muted);
            font-size: 11px;
            text-align: center;
            padding: 20px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            min-width: 230px;
        }

        .action-buttons .btn {
            font-size: 11px;
            padding: 6px 9px;
            border-radius: 4px;
        }

        .status-form {
            display: flex;
            align-items: center;
            gap: 5px;
            width: 100%;
        }

        .status-form select {
            max-width: 135px;
            font-size: 11px;
        }

        @media (max-width: 900px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-wrapper {
                padding: 20px 15px;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 12px 15px;
            }

            .topbar-right {
                gap: 10px;
            }

            .brand {
                font-size: 14px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary-grid {
                gap: 10px;
            }

            .summary-item {
                padding: 14px;
            }

            .summary-item .number {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <!-- Top Navigation -->
    <nav class="topbar">
        <div class="brand">
            ABUHANEEFA ISLAMIC ACADEMY
            <small>Computer-Based Testing Administration</small>
        </div>

        <div class="topbar-right">
            <a href="{{ route('cbt.admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span class="d-none d-md-inline">Dashboard</span>
            </a>

            <span class="text-white-50">|</span>

            <span>
                <i class="bi bi-person-circle"></i>
                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
            </span>

            <form method="POST" action="{{ route('cbt.logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="page-wrapper">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('cbt.admin.dashboard') }}">Dashboard</a>
            <span class="mx-2">/</span>
            Examination Management
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Validation Error -->
        @if ($errors->has('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first('status') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="page-heading">
            <div>
                <h1>Examination Management</h1>
                <p>Create, organise and monitor examinations for registered students.</p>
            </div>

            <a href="{{ route('cbt.admin.examinations.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Create Examination
            </a>
        </div>

        <!-- Summary -->
        <div class="summary-grid">

            <div class="summary-item">
                <div class="label">TOTAL EXAMINATIONS</div>
                <div class="number">{{ $totalExaminations }}</div>
                <div class="description">All examinations in the system</div>
            </div>

            <div class="summary-item">
                <div class="label">DRAFT EXAMINATIONS</div>
                <div class="number">{{ $draftExaminations }}</div>
                <div class="description">Examinations being prepared</div>
            </div>

            <div class="summary-item">
                <div class="label">PUBLISHED EXAMINATIONS</div>
                <div class="number">{{ $publishedExaminations }}</div>
                <div class="description">Available or scheduled examinations</div>
            </div>

            <div class="summary-item">
                <div class="label">COMPLETED EXAMINATIONS</div>
                <div class="number">{{ $completedExaminations }}</div>
                <div class="description">Examinations marked as completed</div>
            </div>

        </div>

        <!-- Examination List -->
        <section class="section-panel">

            <div class="panel-heading">
                <h5>
                    <i class="bi bi-journal-text me-2"></i>
                    Examination Records
                </h5>

                <span class="text-muted small">
                    {{ $examinations->total() }} records
                </span>
            </div>

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Examination</th>
                            <th>Class</th>
                            <th>Academic Year</th>
                            <th>Term</th>
                            <th>Duration</th>
                            <th>Total Marks</th>
                            <th>Mode</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($examinations as $examination)

                            <tr>

                                <td>
                                    <div class="exam-title">
                                        {{ $examination->title }}
                                    </div>

                                    <div class="muted-text">
                                        {{ $examination->subject }}
                                    </div>
                                </td>

                                <td>
                                    {{ $examination->schoolClass?->name ?? 'Class unavailable' }}
                                </td>

                                <td>{{ $examination->academic_year }}</td>

                                <td>{{ $examination->term }}</td>

                                <td>{{ $examination->duration_minutes }} minutes</td>

                                <td>{{ $examination->total_marks }}</td>

                                <td>{{ ucfirst($examination->mode) }}</td>

                                <td>
                                    @php
                                        $statusClass = match ($examination->status) {
                                            'draft' => 'status-draft',
                                            'published' => 'status-published',
                                            'completed' => 'status-completed',
                                            default => 'status-other',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        {{ ucfirst($examination->status) }}
                                    </span>
                                </td>

                                <!-- Examination Actions -->
                                <td>
                                    <div class="action-buttons">

                                        <!-- Change Status -->
                                        <form method="POST"
                                            action="{{ route('cbt.admin.examinations.change-status', $examination) }}"
                                            class="status-form">

                                            @csrf
                                            @method('PATCH')

                                            <select name="status" class="form-select form-select-sm" required>
                                                <option value="draft"
                                                    {{ $examination->status === 'draft' ? 'selected' : '' }}>
                                                    Draft
                                                </option>

                                                <option value="published"
                                                    {{ $examination->status === 'published' ? 'selected' : '' }}>
                                                    Published
                                                </option>

                                                <option value="completed"
                                                    {{ $examination->status === 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>

                                                <option value="cancelled"
                                                    {{ $examination->status === 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-outline-success"
                                                title="Update examination status">
                                                <i class="bi bi-check-lg"></i>
                                                Save
                                            </button>

                                        </form>

                                        <!-- Manage Questions -->
                                        <a href="{{ route('cbt.admin.examinations.questions.index', $examination) }}"
                                            class="btn btn-sm btn-outline-primary" title="Manage questions">
                                            <i class="bi bi-list-check"></i>
                                            Questions
                                        </a>

                                        <!-- Edit Examination -->
                                        <a href="{{ route('cbt.admin.examinations.edit', $examination) }}"
                                            class="btn btn-sm btn-outline-secondary" title="Edit examination">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>

                                        <!-- Delete Examination -->
                                        <form method="POST"
                                            action="{{ route('cbt.admin.examinations.destroy', $examination) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this examination and all its questions? This action cannot be undone.');"
                                            class="m-0">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Delete examination">
                                                <i class="bi bi-trash"></i>
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty-state">

                                        <i class="bi bi-journal-x"></i>

                                        <h6>No examinations found</h6>

                                        <p class="mb-3">
                                            There are currently no examinations in the system.
                                        </p>

                                        <a href="{{ route('cbt.admin.examinations.create') }}" class="btn-primary-custom">
                                            <i class="bi bi-plus-lg"></i>
                                            Create First Examination
                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if ($examinations->hasPages())

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 border-top">

                    <small class="text-muted">
                        Showing {{ $examinations->firstItem() }}
                        to {{ $examinations->lastItem() }}
                        of {{ $examinations->total() }} examinations
                    </small>

                    {{ $examinations->links() }}

                </div>

            @endif

        </section>

        <div class="footer">
            Abuhaneefah Islamic Academy &copy; {{ date('Y') }}.
            All rights reserved.
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
