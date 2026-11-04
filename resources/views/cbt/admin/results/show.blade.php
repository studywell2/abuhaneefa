<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Student Result | Abuhaneefah Islamic Academy</title>

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
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .heading {
            color: var(--navy);
            font-weight: 700;
        }

        .panel {
            background: white;
            border: 1px solid #e5ebef;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 22px;
        }

        .panel-title {
            color: var(--navy);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .detail-label {
            color: #718096;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 700;
            color: var(--navy);
        }

        .score-card {
            background: #f7fafb;
            border: 1px solid #e5ebef;
            border-radius: 10px;
            padding: 20px;
            height: 100%;
        }

        .score-number {
            font-size: 25px;
            font-weight: 700;
            color: var(--blue);
        }

        .final-score {
            background: var(--navy);
            color: white;
            border-radius: 12px;
            padding: 25px;
        }

        .final-score .score-number {
            color: white;
            font-size: 34px;
        }

        .pending {
            background: #fff3d6;
            color: #8a641e;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .approved {
            background: #d9f4e3;
            color: #176b3a;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .rejected {
            background: #fde2e2;
            color: #a52828;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-approve {
            background: #198754;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 7px;
        }

        .btn-approve:hover {
            background: #146c43;
            color: white;
        }

        .btn-reject {
            background: #dc3545;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 7px;
        }

        .btn-reject:hover {
            background: #bb2d3b;
            color: white;
        }

        .table thead th {
            background: #f1f6f8;
            color: #435c6a;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
            border-bottom: 1px solid #e5ebef;
        }

        .table td,
        .table th {
            padding: 14px 15px;
            vertical-align: middle;
        }

        .table-responsive {
            border: 1px solid #e5ebef;
            border-radius: 10px;
        }

        .table {
            margin-bottom: 0;
        }

        .table tbody td {
            color: #354653;
            border-color: #edf1f3;
        }

        .table-hover tbody tr:hover>* {
            background-color: #f7fafb;
        }

        @media(max-width: 768px) {
            .topbar {
                padding: 18px;
            }

            .page-container {
                margin-top: 22px;
            }

            .panel {
                padding: 17px;
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

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h3 class="heading mb-1">Review Student Result</h3>
                <p class="text-secondary mb-0">
                    Verify the student's examination performance before making a decision.
                </p>
            </div>

            <a href="{{ route('cbt.admin.results.index') }}" class="btn btn-outline-secondary">
                Back to Results
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @php
            $exam = $result->attempt->examination;
            $student = $result->attempt->student;
        @endphp

        <div class="panel">
            <h5 class="panel-title">Student Information</h5>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="detail-label">Student Name</div>
                    <div class="detail-value">
                        {{ $student->user->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Admission Number</div>
                    <div class="detail-value">
                        {{ $student->admission_number ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Class</div>
                    <div class="detail-value">
                        {{ $exam->schoolClass->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Examination</div>
                    <div class="detail-value">{{ $exam->title }}</div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Subject</div>
                    <div class="detail-value">{{ $exam->subject }}</div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Academic Year / Term</div>
                    <div class="detail-value">
                        {{ $exam->academic_year }} / {{ $exam->term }}
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <h5 class="panel-title">Examination Score Breakdown</h5>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="detail-label">Continuous Assessment</div>
                        <div class="score-number">
                            {{ $exam->ca_total == 0 ? 0 : ($result->ca_marks ?? 'Pending') }}
                            <small>/ {{ $exam->ca_total }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="detail-label">Objective Examination</div>
                        <div class="score-number">
                            {{ $exam->objective_total == 0 ? 0 : ($result->objective_marks ?? 'Pending') }}
                            <small>/ {{ $exam->objective_total }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="detail-label">Theory Examination</div>
                        <div class="score-number">
                            {{ $exam->theory_total == 0 ? 0 : ($result->theory_marks ?? 'Pending') }}
                            <small>/ {{ $exam->theory_total }}</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="final-score mb-4">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="text-white-50 mb-2">Final Examination Result</div>

                    <div class="score-number">
                        {{ $result->marks_obtained }} / {{ $result->total_marks }}
                    </div>

                    <div class="mt-2">
                        Percentage:
                        <strong>{{ number_format((float) $result->percentage, 2) }}%</strong>
                    </div>
                </div>

                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <div class="text-white-50 mb-2">Examination Outcome</div>

                    <h3 class="text-uppercase fw-bold">
                        {{ $result->outcome }}
                    </h3>

                    @if($result->status === 'pending_approval')
                        <span class="pending">Pending Approval</span>
                    @elseif($result->status === 'approved')
                        <span class="approved">Approved</span>
                    @elseif($result->status === 'rejected')
                        <span class="rejected">Rejected</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel">
            <h5 class="panel-title">Examiner Review Information</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="detail-label">Reviewed By</div>
                    <div class="detail-value">
                        {{ $result->examiner->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Review Date</div>
                    <div class="detail-value">
                        {{ $result->reviewed_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-12">
                    <div class="detail-label">Examiner's Remarks</div>
                    <div>
                        {{ $result->remarks ?: 'No examiner remarks provided.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <h5 class="panel-title">Score Entry Audit History</h5>

            @if($result->scoreAudits->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Component</th>
                                <th>Previous Score</th>
                                <th>New Score</th>
                                <th>Entered By</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($result->scoreAudits as $audit)
                                <tr>
                                    <td>{{ ucfirst($audit->component) }}</td>
                                    <td>{{ $audit->old_marks ?? 'Not entered' }}</td>
                                    <td>{{ $audit->new_marks }}</td>
                                    <td>{{ $audit->examiner->name ?? 'N/A' }}</td>
                                    <td>
                                        {{ $audit->entered_at?->format('d M Y, h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <p class="text-secondary mb-0">
                    No manual score changes have been recorded.
                </p>

            @endif
        </div>

        @if($result->status === 'pending_approval')

            <div class="panel">
                <h5 class="panel-title">Administrator Decision</h5>

                <p class="text-secondary">
                    Approving this result will mark it as approved for the
                    next stage of student result access. Rejecting it will
                    return it for correction.
                </p>

                <div class="d-flex flex-wrap gap-3">

                    <form method="POST" action="{{ route('cbt.admin.results.approve', $result) }}"
                        onsubmit="return confirm('Are you sure you want to approve this student result?');">

                        @csrf

                        <button type="submit" class="btn-approve">
                            Approve Result
                        </button>
                    </form>

                    <button type="button" class="btn-reject" data-bs-toggle="collapse" data-bs-target="#rejectionForm">
                        Reject Result
                    </button>

                </div>

                <div class="collapse mt-4" id="rejectionForm">

                    <form method="POST" action="{{ route('cbt.admin.results.reject', $result) }}">

                        @csrf

                        <label class="form-label fw-bold">
                            Reason for Rejection
                        </label>

                        <textarea name="rejection_reason" class="form-control" rows="4" minlength="5" maxlength="5000"
                            required
                            placeholder="Explain why this result is being rejected...">{{ old('rejection_reason') }}</textarea>

                        <button type="submit" class="btn btn-danger mt-3"
                            onclick="return confirm('Are you sure you want to reject this result?');">
                            Confirm Rejection
                        </button>

                    </form>

                </div>
            </div>

        @elseif($result->status === 'approved')

            <div class="alert alert-success">
                This result has been approved by
                <strong>{{ $result->approver->name ?? 'the administrator' }}</strong>.

                @if($result->approved_at)
                    Approval date:
                    {{ $result->approved_at->format('d M Y, h:i A') }}.
                @endif
            </div>

        @elseif($result->status === 'rejected')

            <div class="alert alert-danger">
                This result has been rejected.

                <div class="mt-2">
                    {{ $result->remarks }}
                </div>
            </div>

        @endif

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>