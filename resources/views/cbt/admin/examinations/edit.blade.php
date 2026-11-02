
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Examination | Abuhaneefah Islamic Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F7F6F1;
            color: #26332F;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #244C40;
            color: white;
            padding: 20px 0;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
        }

        .main-content {
            max-width: 950px;
            margin: 35px auto;
        }

        .form-card {
            background: white;
            border: 1px solid #E5E8E4;
            border-radius: 10px;
            padding: 30px;
        }

        .section-title {
            color: #244C40;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            color: #34443D;
        }

        .form-control, .form-select {
            padding: 11px;
            border-color: #D8DED9;
        }

        .form-control:focus, .form-select:focus {
            border-color: #244C40;
            box-shadow: 0 0 0 0.2rem rgba(36, 76, 64, 0.12);
        }

        .btn-academy {
            background: #244C40;
            color: white;
            padding: 11px 22px;
        }

        .btn-academy:hover {
            background: #173B30;
            color: white;
        }

        .btn-cancel {
            background: #E9ECE9;
            color: #26332F;
            padding: 11px 22px;
        }

        .info-panel {
            background: #F3F7F4;
            border: 1px solid #DCE7DF;
            border-radius: 8px;
            padding: 16px;
        }

        footer {
            text-align: center;
            color: #777;
            padding: 25px 10px;
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="container">
        <div class="brand">ABUHANEEFAH ISLAMIC ACADEMY</div>
        <div>Computer-Based Testing Administration</div>
    </div>
</header>

<main class="container main-content">

    <div class="mb-4">
        <a href="{{ route('cbt.admin.dashboard') }}" class="text-decoration-none text-secondary">
            Dashboard
        </a>
        /
        <a href="{{ route('cbt.admin.examinations.index') }}" class="text-decoration-none text-secondary">
            Examination Management
        </a>
        / Edit Examination
    </div>

    <div class="mb-4">
        <h3 class="section-title">Edit Examination</h3>
        <p class="text-secondary mb-0">
            Update the examination details below. Existing questions will be preserved.
        </p>
    </div>

    <div class="form-card">

        <div class="info-panel mb-4">
            <div class="fw-bold mb-1">Examination: {{ $examination->title }}</div>
            <div class="text-secondary small">
                Questions currently added: {{ $examination->questions()->count() }}
                |
                Marks already allocated: {{ $allocatedMarks }}
                |
                Remaining marks: {{ $examination->total_marks - $allocatedMarks }}
            </div>
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
              action="{{ route('cbt.admin.examinations.update', $examination) }}">

            @csrf
            @method('PUT')

            <h5 class="section-title mb-3">Basic Information</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Examination Title</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $examination->title) }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Subject</label>
                    <input type="text"
                           name="subject"
                           class="form-control"
                           value="{{ old('subject', $examination->subject) }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Class</label>
                    <select name="school_class_id" class="form-select" required>
                        <option value="">Select class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                @selected(old('school_class_id', $examination->school_class_id) == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Academic Year</label>
                    <input type="text"
                           name="academic_year"
                           class="form-control"
                           value="{{ old('academic_year', $examination->academic_year) }}"
                           placeholder="2026/2027"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Term</label>
                    <select name="term" class="form-select" required>
                        @foreach (['First', 'Second', 'Third'] as $term)
                            <option value="{{ $term }}"
                                @selected(old('term', $examination->term) == $term)>
                                {{ $term }} Term
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Examination Mode</label>
                    <select name="mode" class="form-select" required>
                        <option value="online"
                            @selected(old('mode', $examination->mode) == 'online')>
                            Online
                        </option>
                        <option value="physical"
                            @selected(old('mode', $examination->mode) == 'physical')>
                            Physical Centre
                        </option>
                    </select>
                </div>

            </div>

            <hr class="my-4">

            <h5 class="section-title mb-3">Examination Settings</h5>

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Duration (Minutes)</label>
                    <input type="number"
                           name="duration_minutes"
                           class="form-control"
                           min="1"
                           value="{{ old('duration_minutes', $examination->duration_minutes) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total Marks</label>
                    <input type="number"
                           name="total_marks"
                           class="form-control"
                           min="{{ max(1, $allocatedMarks) }}"
                           value="{{ old('total_marks', $examination->total_marks) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Pass Mark</label>
                    <input type="number"
                           name="pass_mark"
                           class="form-control"
                           min="0"
                           max="{{ old('total_marks', $examination->total_marks) }}"
                           value="{{ old('pass_mark', $examination->pass_mark) }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Start Date and Time</label>
                    <input type="datetime-local"
                           name="start_time"
                           class="form-control"
                           value="{{ old('start_time', $examination->start_time?->format('Y-m-d\TH:i')) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">End Date and Time</label>
                    <input type="datetime-local"
                           name="end_time"
                           class="form-control"
                           value="{{ old('end_time', $examination->end_time?->format('Y-m-d\TH:i')) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Examination Instructions</label>
                    <textarea name="instructions"
                              class="form-control"
                              rows="4"
                              placeholder="Enter instructions for students...">{{ old('instructions', $examination->instructions) }}</textarea>
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('cbt.admin.examinations.index') }}"
                   class="btn btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-academy">
                    Save Changes
                </button>
            </div>

        </form>

    </div>

</main>

<footer>
    Abuhaneefah Islamic Academy © {{ date('Y') }}. All rights reserved.
</footer>

</body>
</html>
