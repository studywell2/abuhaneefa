
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Approval | Abuhaneefah Islamic Academy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --light: #F3F7F8;
        }

        body {
            background: var(--light);
            font-family: Arial, sans-serif;
            color: #263746;
        }

        .topbar {
            background: var(--navy);
            color: white;
            padding: 22px 35px;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
        }

        .subtitle {
            color: #d5e1e7;
            font-size: 13px;
        }

        .page-container {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-heading {
            color: var(--navy);
            font-weight: 700;
        }

        .info-card {
            background: white;
            border: 1px solid #e5ebef;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5ebef;
            box-shadow: 0 8px 24px rgba(23, 59, 77, 0.05);
        }

        .table-responsive {
            border: 1px solid #e5ebef;
            border-radius: 10px;
        }

        .table thead th {
            background: #f1f6f8;
            color: #435c6a;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 15px 14px;
            border-bottom: 1px solid #e5ebef;
        }

        .table tbody td {
            padding: 16px 14px;
            vertical-align: middle;
            font-size: 13px;
            color: #354653;
            border-color: #edf1f3;
        }

        .table-hover tbody tr:hover > * {
            background-color: #f7fafb;
        }

        .status {
            display: inline-block;
            background: #fff3d6;
            color: #8a641e;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-view {
            background: var(--blue);
            color: white;
            border-radius: 7px;
            padding: 8px 14px;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-view:hover {
            background: var(--navy);
            color: white;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
            color: #718096;
        }

        .empty-state h5 {
            color: var(--navy);
            font-weight: 700;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 18px;
            }

            .page-container {
                margin-top: 22px;
            }

            .table-card {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="container-fluid">
        <div class="brand">ABUHANEEFAH ISLAMIC ACADEMY</div>
        <div class="subtitle">Computer-Based Testing Management System</div>
    </div>
</header>

<main class="page-container">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="page-heading mb-1">Result Approval</h3>
            <p class="text-secondary mb-0">
                Review examination results submitted by examiners.
            </p>
        </div>

        <a href="{{ route('cbt.admin.dashboard') }}"
           class="btn btn-outline-secondary">
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="info-card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="fw-bold mb-1" style="color: var(--navy);">
                    Administrator Review Centre
                </h5>

                <p class="text-secondary mb-0">
                    Only results reviewed and submitted by examiners appear here.
                    Approve a result only after verifying its scores and details.
                </p>
            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="text-secondary small">Awaiting Approval</div>
                <div class="fs-2 fw-bold" style="color: var(--blue);">
                    {{ $results->total() }}
                </div>
            </div>
        </div>
    </div>

    <div class="table-card">

        <h5 class="fw-bold mb-3" style="color: var(--navy);">
            Submitted Results
        </h5>

        @if($results->count() > 0)

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Examination</th>
                            <th>Class</th>
                            <th>Academic Year</th>
                            <th>Term</th>
                            <th>Final Score</th>
                            <th>Examiner</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($results as $result)

                            <tr>
                                <td>
                                    <div class="fw-bold">
                                        {{ $result->attempt->student->user->name ?? 'Student' }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $result->attempt->student->admission_number ?? 'N/A' }}
                                    </small>
                                </td>

                                <td>
                                    {{ $result->attempt->examination->title ?? 'N/A' }}
                                    <br>
                                    <small class="text-secondary">
                                        {{ $result->attempt->examination->subject ?? '' }}
                                    </small>
                                </td>

                                <td>
                                    {{ $result->attempt->examination->schoolClass->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->attempt->examination->academic_year ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->attempt->examination->term ?? 'N/A' }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $result->marks_obtained }}/{{ $result->total_marks }}
                                    </strong>
                                    <br>
                                    <small class="text-secondary">
                                        {{ number_format((float) $result->percentage, 2) }}%
                                    </small>
                                </td>

                                <td>
                                    {{ $result->examiner->name ?? 'N/A' }}
                                </td>

                                <td>
                                    <span class="status">
                                        Pending Approval
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('cbt.admin.results.show', $result) }}"
                                       class="btn-view">
                                        Review Result
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

            <div>
                {{ $results->links() }}
            </div>

        @else

            <div class="empty-state">
                <h5>No Results Awaiting Approval</h5>

                <p class="mb-0">
                    There are currently no examiner-submitted results
                    waiting for administrator approval.
                </p>
            </div>

        @endif

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
