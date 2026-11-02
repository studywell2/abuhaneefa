
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question | Abuhaneefah Islamic Academy</title>

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
            max-width: 1100px;
            margin: auto;
        }

        .breadcrumb {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 15px;
        }

        .breadcrumb a {
            color: var(--navy-light);
            text-decoration: none;
        }

        .page-heading {
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

        .section-panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 5px;
            margin-bottom: 22px;
        }

        .panel-heading {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
        }

        .panel-heading h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            margin: 0;
        }

        .panel-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            font-size: 13px;
            border-color: #dce2e7;
            border-radius: 4px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px rgba(49, 92, 114, .10);
        }

        textarea.form-control {
            min-height: 120px;
        }

        .option-label {
            font-weight: 700;
            color: var(--navy);
            font-size: 12px;
        }

        .information-box {
            background: #f5f8fa;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 14px 16px;
            margin-bottom: 22px;
        }

        .information-box p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-primary-custom {
            background: var(--navy);
            color: white;
            border: 1px solid var(--navy);
            padding: 10px 17px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
        }

        .btn-primary-custom:hover {
            background: var(--navy-light);
            color: white;
        }

        .btn-secondary-custom {
            background: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
            padding: 10px 17px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-secondary-custom:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .footer {
            color: var(--muted);
            font-size: 11px;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 12px 15px;
            }

            .brand {
                font-size: 14px;
            }

            .topbar-right {
                gap: 10px;
            }

            .page-wrapper {
                padding: 20px 15px;
            }

            .panel-body {
                padding: 18px;
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

        </div>

    </nav>

    <main class="page-wrapper">

        <!-- Breadcrumb -->
        <div class="breadcrumb">

            <a href="{{ route('cbt.admin.dashboard') }}">Dashboard</a>

            <span class="mx-2">/</span>

            <a href="{{ route('cbt.admin.examinations.index') }}">
                Examination Management
            </a>

            <span class="mx-2">/</span>

            <a href="{{ route('cbt.admin.examinations.questions.index', $examination) }}">
                Question Management
            </a>

            <span class="mx-2">/</span>

            Edit Question

        </div>

        <!-- Page Heading -->
        <div class="page-heading">

            <h1>Edit Examination Question</h1>

            <p>Update the question, answer options and allocated marks.</p>

        </div>

        <!-- Examination Information -->
        <section class="section-panel">

            <div class="panel-heading">
                <h5>
                    <i class="bi bi-journal-text me-2"></i>
                    {{ $examination->title }}
                </h5>
            </div>

            <div class="panel-body">

                <div class="row g-3">

                    <div class="col-md-4">
                        <small class="text-muted">Subject</small>
                        <div class="fw-bold">{{ $examination->subject }}</div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Class</small>
                        <div class="fw-bold">
                            {{ $examination->schoolClass?->name ?? 'Class unavailable' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Total Examination Marks</small>
                        <div class="fw-bold">{{ $examination->total_marks }}</div>
                    </div>

                </div>

            </div>

        </section>

        <!-- Edit Question Form -->
        <section class="section-panel">

            <div class="panel-heading">
                <h5>
                    <i class="bi bi-pencil-square me-2"></i>
                    Question Details
                </h5>
            </div>

            <div class="panel-body">

                <div class="information-box">

                    <p>
                        <i class="bi bi-info-circle me-1"></i>

                        Other questions currently account for
                        <strong>{{ $allocatedMarks }} marks</strong>.
                        You can allocate up to
                        <strong>{{ $remainingMarks }} marks</strong>
                        to this question.
                    </p>

                </div>

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>Please correct the following errors:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form method="POST"
                    action="{{ route('cbt.admin.examinations.questions.update', [$examination, $question]) }}">

                    @csrf
                    @method('PUT')

                    <!-- Question Text -->
                    <div class="mb-4">

                        <label class="form-label">
                            Question
                        </label>

                        <textarea name="question_text"
                            class="form-control"
                            rows="4"
                            required>{{ old('question_text', $question->question_text) }}</textarea>

                    </div>

                    <!-- Answer Options -->
                    <div class="mb-3">

                        <label class="form-label">
                            Answer Options
                        </label>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="option-label mb-2">
                                Option A
                            </label>

                            <input type="text"
                                name="option_a"
                                class="form-control"
                                value="{{ old('option_a', $question->option_a) }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="option-label mb-2">
                                Option B
                            </label>

                            <input type="text"
                                name="option_b"
                                class="form-control"
                                value="{{ old('option_b', $question->option_b) }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="option-label mb-2">
                                Option C
                            </label>

                            <input type="text"
                                name="option_c"
                                class="form-control"
                                value="{{ old('option_c', $question->option_c) }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="option-label mb-2">
                                Option D
                            </label>

                            <input type="text"
                                name="option_d"
                                class="form-control"
                                value="{{ old('option_d', $question->option_d) }}"
                                required>

                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="row g-3">

                        <!-- Correct Answer -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Correct Answer
                            </label>

                            <select name="correct_option" class="form-select" required>

                                <option value="A"
                                    {{ old('correct_option', $question->correct_option) === 'A' ? 'selected' : '' }}>
                                    Option A
                                </option>

                                <option value="B"
                                    {{ old('correct_option', $question->correct_option) === 'B' ? 'selected' : '' }}>
                                    Option B
                                </option>

                                <option value="C"
                                    {{ old('correct_option', $question->correct_option) === 'C' ? 'selected' : '' }}>
                                    Option C
                                </option>

                                <option value="D"
                                    {{ old('correct_option', $question->correct_option) === 'D' ? 'selected' : '' }}>
                                    Option D
                                </option>

                            </select>

                        </div>

                        <!-- Marks -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Question Marks
                            </label>

                            <input type="number"
                                name="marks"
                                class="form-control"
                                min="1"
                                max="{{ $remainingMarks }}"
                                value="{{ old('marks', $question->marks) }}"
                                required>

                            <small class="text-muted">
                                Maximum available marks: {{ $remainingMarks }}
                            </small>

                        </div>

                    </div>

                    <!-- Form Buttons -->
                    <div class="d-flex flex-wrap gap-2 mt-4">

                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check-circle"></i>
                            Save Changes
                        </button>

                        <a href="{{ route('cbt.admin.examinations.questions.index', $examination) }}"
                            class="btn-secondary-custom">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </section>

        <div class="footer">
            Abuhaneefah Islamic Academy &copy; {{ date('Y') }}.
            All rights reserved.
        </div>

    </main>

</body>

</html>
