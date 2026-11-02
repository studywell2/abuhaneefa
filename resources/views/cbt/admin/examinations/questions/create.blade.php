
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question | Abuhaneefah Islamic Academy</title>

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

        .container-main {
            max-width: 900px;
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
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #35483e;
        }

        .form-control, .form-select {
            padding: 11px;
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

        .help-text {
            color: #78817b;
            font-size: 13px;
        }

        footer {
            text-align: center;
            color: #777;
            padding: 25px;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="topbar">
    <strong>ABUHANEEFA ISLAMIC ACADEMY</strong>
    <span class="float-end">Computer-Based Testing Administration</span>
</div>

<div class="container-main">

    <div class="mb-4">
        <a href="{{ route('cbt.admin.examinations.index') }}"
           class="text-decoration-none text-secondary">
            Examination Management
        </a>

        <span class="text-secondary"> / </span>

        <a href="{{ route('cbt.admin.examinations.questions.index', $examination) }}"
           class="text-decoration-none text-secondary">
            Questions
        </a>

        <span class="text-secondary"> / Add Question</span>
    </div>

    <h3 class="page-title mb-1">Add Examination Question</h3>

    <p class="text-secondary mb-4">
        {{ $examination->title }} — {{ $examination->subject }}
    </p>

    <div class="card-box mb-4">

        <div class="row g-3">

            <div class="col-md-4">
                <div class="help-text">Total examination marks</div>
                <strong>{{ $examination->total_marks }}</strong>
            </div>

            <div class="col-md-4">
                <div class="help-text">Marks already allocated</div>
                <strong>{{ $allocatedMarks }}</strong>
            </div>

            <div class="col-md-4">
                <div class="help-text">Remaining marks</div>
                <strong class="text-success">
                    {{ max(0, $examination->total_marks - $allocatedMarks) }}
                </strong>
            </div>

        </div>

    </div>

    @if($errors->any())
        <div class="alert alert-danger">

            <strong>Please correct the following:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <div class="card-box">

        <form method="POST"
              action="{{ route('cbt.admin.examinations.questions.store', $examination) }}">

            @csrf

            <div class="mb-4">

                <label class="form-label">Question</label>

                <textarea name="question_text"
                          rows="4"
                          class="form-control"
                          placeholder="Enter the examination question..."
                          required>{{ old('question_text') }}</textarea>

            </div>

            <h6 class="fw-bold mb-3">Answer Options</h6>

            <div class="mb-3">

                <label class="form-label">Option A</label>

                <input type="text"
                       name="option_a"
                       class="form-control"
                       value="{{ old('option_a') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">Option B</label>

                <input type="text"
                       name="option_b"
                       class="form-control"
                       value="{{ old('option_b') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">Option C</label>

                <input type="text"
                       name="option_c"
                       class="form-control"
                       value="{{ old('option_c') }}"
                       required>

            </div>

            <div class="mb-4">

                <label class="form-label">Option D</label>

                <input type="text"
                       name="option_d"
                       class="form-control"
                       value="{{ old('option_d') }}"
                       required>

            </div>

            <hr class="my-4">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">Correct Answer</label>

                    <select name="correct_option" class="form-select" required>

                        <option value="">Select the correct option</option>

                        <option value="A" {{ old('correct_option') == 'A' ? 'selected' : '' }}>
                            Option A
                        </option>

                        <option value="B" {{ old('correct_option') == 'B' ? 'selected' : '' }}>
                            Option B
                        </option>

                        <option value="C" {{ old('correct_option') == 'C' ? 'selected' : '' }}>
                            Option C
                        </option>

                        <option value="D" {{ old('correct_option') == 'D' ? 'selected' : '' }}>
                            Option D
                        </option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="form-label">Question Marks</label>

                    <input type="number"
                           name="marks"
                           class="form-control"
                           min="1"
                           max="{{ max(0, $examination->total_marks - $allocatedMarks) }}"
                           value="{{ old('marks', 1) }}"
                           required>

                    <div class="help-text mt-1">
                        Maximum available:
                        {{ max(0, $examination->total_marks - $allocatedMarks) }}
                        marks.
                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2 mt-4">

                <a href="{{ route('cbt.admin.examinations.questions.index', $examination) }}"
                   class="btn btn-outline-secondary px-4">
                    Cancel
                </a>

                <button type="submit" class="btn btn-academy px-4">
                    Save Question
                </button>

            </div>

        </form>

    </div>

</div>

<footer>
    Abuhaneefah Islamic Academy &copy; {{ date('Y') }}. All rights reserved.
</footer>

</body>
</html>
