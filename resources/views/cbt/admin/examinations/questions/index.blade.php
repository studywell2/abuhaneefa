
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Management | Abuhaneefah Islamic Academy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F7F6F1;
            color: #26332E;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #244C40;
            color: white;
            padding: 17px 5%;
        }

        .topbar strong {
            font-size: 17px;
        }

        .container-main {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .page-title {
            color: #244C40;
            font-weight: 700;
        }

        .card-box {
            background: white;
            border: 1px solid #e8e6de;
            border-radius: 9px;
            padding: 22px;
        }

        .stat-label {
            color: #737b76;
            font-size: 13px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: #244C40;
        }

        .btn-academy {
            background: #244C40;
            color: white;
            border: 0;
        }

        .btn-academy:hover {
            background: #193B32;
            color: white;
        }

        .table-responsive {
            border: 1px solid #e4ebe7;
            border-radius: 12px;
            box-shadow: 0 8px 22px rgba(36, 76, 64, .05);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f2f7f4;
            color: #52615a;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 15px 16px;
            border-bottom: 1px solid #e4ebe7;
        }

        .table td {
            vertical-align: middle;
            padding: 15px 16px;
            color: #35443d;
            border-color: #edf1ee;
        }

        .table tbody tr {
            transition: background-color .18s ease;
        }

        .table-hover tbody tr:hover > * {
            background-color: #f7faf8;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        footer {
            text-align: center;
            color: #777;
            padding: 25px;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 15px;
            }

            .topbar strong {
                font-size: 14px;
            }

            .container-main {
                margin-top: 22px;
            }
        }
    </style>
</head>

<body>

<div class="topbar">
    <strong>ABUHANEEFA ISLAMIC ACADEMY</strong>
    <span class="float-end">Computer-Based Testing Administration</span>
</div>

<div class="container-main">

    <!-- Breadcrumb -->
    <div class="mb-4">
        <a href="{{ route('cbt.admin.examinations.index') }}"
           class="text-decoration-none text-secondary">
            Examination Management
        </a>

        <span class="text-secondary"> / </span>
        <span>Question Management</span>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">

            <strong>Please correct the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="page-title mb-1">Question Management</h3>

            <p class="text-secondary mb-0">
                Manage questions for this examination.
            </p>
        </div>

        <a href="{{ route('cbt.admin.examinations.questions.create', $examination) }}"
           class="btn btn-academy px-4">
            + Add Question
        </a>

    </div>

    <!-- Examination Information -->
    <div class="card-box mb-4">

        <h5 class="fw-bold mb-3">
            {{ $examination->title }}
        </h5>

        <div class="row g-3">

            <div class="col-md-3">
                <div class="stat-label">Subject</div>
                <strong>{{ $examination->subject }}</strong>
            </div>

            <div class="col-md-3">
                <div class="stat-label">Class</div>
                <strong>{{ $examination->schoolClass?->name ?? 'Class unavailable' }}</strong>
            </div>

            <div class="col-md-3">
                <div class="stat-label">Total Examination Marks</div>
                <strong>{{ $examination->total_marks }}</strong>
            </div>

            <div class="col-md-3">
                <div class="stat-label">Duration</div>
                <strong>{{ $examination->duration_minutes }} minutes</strong>
            </div>

        </div>

    </div>

    <!-- Question Statistics -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-label">Total Questions</div>
                <div class="stat-value">{{ $questionCount }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-label">Allocated Marks</div>
                <div class="stat-value">{{ $allocatedMarks }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-label">Remaining Marks</div>
                <div class="stat-value">
                    {{ max(0, $examination->total_marks - $allocatedMarks) }}
                </div>
            </div>
        </div>

    </div>

    <!-- Examination Questions -->
    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="fw-bold mb-0">
                Examination Questions
            </h5>

            <span class="text-secondary small">
                {{ $questionCount }} questions
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Question</th>
                        <th>Correct Answer</th>
                        <th>Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($questions as $question)

                        <tr>

                            <td>
                                {{ $questions->firstItem() + $loop->index }}
                            </td>

                            <td style="min-width: 250px;">
                                {{ \Illuminate\Support\Str::limit($question->question_text, 100) }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Option {{ $question->correct_option }}
                                </span>
                            </td>

                            <td>
                                {{ $question->marks }}
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <!-- Edit Question -->
                                    <a href="{{ route('cbt.admin.examinations.questions.edit', [$examination, $question]) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <!-- Delete Question -->
                                    <form method="POST"
                                          action="{{ route('cbt.admin.examinations.questions.destroy', [$examination, $question]) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this question?')"
                                          class="m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-5">

                                <h6 class="fw-bold">
                                    No questions added yet
                                </h6>

                                <p class="text-secondary mb-3">
                                    Start by adding questions to this examination.
                                </p>

                                <a href="{{ route('cbt.admin.examinations.questions.create', $examination) }}"
                                   class="btn btn-academy">
                                    Add First Question
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $questions->links() }}

    </div>

    <!-- Back Link -->
    <div class="mt-4">
        <a href="{{ route('cbt.admin.examinations.index') }}"
           class="text-decoration-none text-secondary">
            &larr; Back to Examination Management
        </a>
    </div>

</div>

<footer>
    Abuhaneefah Islamic Academy &copy; {{ date('Y') }}. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
