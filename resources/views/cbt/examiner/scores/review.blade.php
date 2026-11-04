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
            color: #263746;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: var(--navy);
            color: white;
            padding: 22px 0;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 12px;
            color: #dce7ec;
            letter-spacing: 1px;
        }

        .page-title {
            font-weight: 700;
            color: var(--navy);
        }

        .panel {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5ebef;
            margin-bottom: 22px;
        }

        .section-title {
            font-weight: 700;
            color: var(--navy);
            font-size: 17px;
            margin-bottom: 18px;
        }

        .info-label {
            color: #718096;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            color: #263746;
        }

        .score-card {
            background: #f8fafb;
            border: 1px solid #e5ebef;
            padding: 18px;
            border-radius: 10px;
            height: 100%;
        }

        .score-card .label {
            color: #718096;
            font-size: 13px;
        }

        .score-card .value {
            color: var(--navy);
            font-size: 24px;
            font-weight: 700;
            margin-top: 7px;
        }

        .final-score {
            background: var(--navy);
            color: white;
            border-radius: 12px;
            padding: 25px;
        }

        .final-score .score {
            font-size: 34px;
            font-weight: 700;
        }

        .btn-primary-custom {
            background: var(--blue);
            border: none;
            color: white;
            padding: 11px 20px;
            border-radius: 7px;
        }

        .btn-primary-custom:hover {
            background: var(--navy);
            color: white;
        }

        .gold-line {
            width: 45px;
            height: 3px;
            background: var(--gold);
            margin-top: 8px;
            margin-bottom: 20px;
        }

        footer {
            color: #718096;
            font-size: 12px;
            text-align: center;
            padding: 25px 0;
        }
    </style>
</head>

<body>

    <header class="topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <div class="brand">ABUHANEEFAH ISLAMIC ACADEMY</div>
                <div class="subtitle">EXAMINATION MANAGEMENT SYSTEM</div>
            </div>

            <div class="text-end">
                <div class="small">Examiner Portal</div>
                <div class="fw-semibold">{{ auth()->user()->name }}</div>
            </div>
        </div>
    </header>

    <main class="container py-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <a href="{{ route('cbt.examiner.examinations.scores.index', $examination) }}"
                    class="text-decoration-none text-secondary small">
                    ← Back to Student Scores
                </a>

                <h3 class="page-title mt-2 mb-1">Review Student Result</h3>

                <div class="text-secondary small">
                    Examine the score components before submitting for administrator approval.
                </div>
            </div>

            <span class="badge bg-warning text-dark px-3 py-2">
                {{ ucwords(str_replace('_', ' ', $result->status)) }}
            </span>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please correct the following:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- STUDENT INFORMATION --}}

        <section class="panel">

            <h5 class="section-title">Student Information</h5>
            <div class="gold-line"></div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="info-label">Student Name</div>
                    <div class="info-value">
                        {{ $result->attempt->student->user->name ?? 'Student' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Admission Number</div>
                    <div class="info-value">
                        {{ $result->attempt->student->admission_number ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Class</div>
                    <div class="info-value">
                        {{ $examination->schoolClass->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Examination</div>
                    <div class="info-value">{{ $examination->title }}</div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Subject</div>
                    <div class="info-value">{{ $examination->subject }}</div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Academic Year / Term</div>
                    <div class="info-value">
                        {{ $examination->academic_year }} /
                        {{ $examination->term }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Examination Mode</div>
                    <div class="info-value text-capitalize">
                        {{ $examination->mode }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-label">Submission Date</div>
                    <div class="info-value">
                        {{ $result->attempt->submitted_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </div>
                </div>

            </div>

        </section>

        {{-- SCORE COMPONENTS --}}

        <section class="panel">

            <h5 class="section-title">Score Components</h5>
            <div class="gold-line"></div>

            <div class="row g-3">

                {{-- CA --}}

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="label">Continuous Assessment (CA)</div>
                        <div class="value">

                            @if ($examination->ca_total == 0)
                                0
                            @else
                                {{ $result->ca_marks ?? 'Pending' }}
                            @endif

                            <small class="fs-6 text-secondary">
                                / {{ $examination->ca_total }}
                            </small>

                        </div>
                    </div>
                </div>

                {{-- OBJECTIVE --}}

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="label">Objective</div>
                        <div class="value">

                            @if ($examination->objective_total == 0)
                                0
                            @else
                                {{ $result->objective_marks ?? 'Pending' }}
                            @endif

                            <small class="fs-6 text-secondary">
                                / {{ $examination->objective_total }}
                            </small>

                        </div>
                    </div>
                </div>

                {{-- THEORY --}}

                <div class="col-md-4">
                    <div class="score-card">
                        <div class="label">Theory</div>
                        <div class="value">

                            @if ($examination->theory_total == 0)
                                0
                            @else
                                {{ $result->theory_marks ?? 'Pending' }}
                            @endif

                            <small class="fs-6 text-secondary">
                                / {{ $examination->theory_total }}
                            </small>

                        </div>
                    </div>
                </div>

            </div>

        </section>

        {{-- FINAL RESULT --}}

        <section class="final-score mb-4">

            <div class="row align-items-center">

                <div class="col-md-6">
                    <div class="text-white-50 small">FINAL EXAMINATION SCORE</div>

                    <div class="score">
                        {{ $result->marks_obtained }}
                        <span class="fs-5 fw-normal">
                            / {{ $result->total_marks }}
                        </span>
                    </div>

                    <div class="mt-2">
                        Percentage:
                        <strong>{{ number_format((float) $result->percentage, 2) }}%</strong>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mt-md-0 text-md-end">

                    <div class="text-white-50 small">EXAMINATION OUTCOME</div>

                    @if ($result->outcome === 'passed')
                        <span class="badge bg-success fs-6 mt-2 px-3 py-2">
                            PASSED
                        </span>
                    @elseif ($result->outcome === 'failed')
                        <span class="badge bg-danger fs-6 mt-2 px-3 py-2">
                            FAILED
                        </span>
                    @else
                        <span class="badge bg-warning text-dark fs-6 mt-2 px-3 py-2">
                            {{ strtoupper($result->outcome) }}
                        </span>
                    @endif

                </div>

            </div>

        </section>

        {{-- SCORE ENTRY HISTORY --}}

        <section class="panel">

            <h5 class="section-title">Score Entry History</h5>
            <div class="gold-line"></div>

            @if ($result->scoreAudits->isNotEmpty())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Component</th>
                                <th>Previous Score</th>
                                <th>New Score</th>
                                <th>Entered By</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($result->scoreAudits as $audit)

                                <tr>
                                    <td>{{ ucwords(str_replace('_', ' ', $audit->component)) }}</td>

                                    <td>{{ $audit->old_marks ?? 'First Entry' }}</td>

                                    <td class="fw-bold">{{ $audit->new_marks }}</td>

                                    <td>{{ $audit->examiner->name ?? 'Unknown' }}</td>

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
                    No manual score-entry history is available for this result.
                </p>

            @endif

        </section>

        {{-- EXAMINER REVIEW FORM --}}

        @if ($result->status === 'pending_review')

            <section class="panel">

                <h5 class="section-title">Examiner Review and Submission</h5>
                <div class="gold-line"></div>

                <div class="alert alert-info">
                    Please verify the student's scores and examination outcome.
                    Once submitted, this result will move to the administrator
                    for final approval. You will no longer be able to edit the scores.
                </div>

                <form method="POST"
                    action="{{ route('cbt.examiner.examinations.scores.submit-review', [$examination, $result]) }}"
                    onsubmit="return confirm('Have you checked the scores? Submit this result for administrator approval?');">

                    @csrf

                    <div class="mb-3">

                        <label for="remarks" class="form-label fw-semibold">
                            Examiner's Remarks (Optional)
                        </label>

                        <textarea name="remarks" id="remarks" rows="4" class="form-control" maxlength="5000"
                            placeholder="Enter any observations or comments about this result...">{{ old('remarks') }}</textarea>

                    </div>

                    <button type="submit" class="btn btn-primary-custom">
                        Submit for Administrator Approval
                    </button>

                </form>

            </section>

        @else

            <div class="alert alert-secondary">
                This result is no longer awaiting examiner review.
                Current status:
                <strong>{{ ucwords(str_replace('_', ' ', $result->status)) }}</strong>
            </div>

            @if ($result->remarks)
                <section class="panel">
                    <h5 class="section-title">Review Remarks</h5>
                    <p class="mb-0">{{ $result->remarks }}</p>
                </section>
            @endif

        @endif

        <div class="mb-4">
            <a href="{{ route('cbt.examiner.examinations.scores.index', $examination) }}"
                class="btn btn-outline-secondary">
                Back to Student Scores
            </a>
        </div>

    </main>

    <footer>
        &copy; {{ date('Y') }} Abuhaneefah Islamic Academy.
        Examination Management System.
    </footer>

</body>

</html>