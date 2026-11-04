
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

        .form-control[readonly] {
            background: #F0F3F0;
            font-weight: 700;
            color: #244C40;
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

        .score-note {
            background: #F3F7F4;
            border: 1px solid #DCE7DF;
            border-radius: 8px;
            padding: 14px;
            font-size: 13px;
        }

        .department-note {
            background: #F3F7F4;
            border: 1px solid #DCE7DF;
            border-radius: 8px;
            padding: 12px;
            font-size: 12px;
            margin-top: 8px;
        }

        .form-text {
            font-size: 11px;
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
            <div class="fw-bold mb-1">
                Examination: {{ $examination->title }}
            </div>

            <div class="text-secondary small">
                Questions currently added: {{ $examination->questions()->count() }}
                |
                Marks already allocated: {{ $allocatedMarks }}
                |
                Remaining objective marks: {{ $examination->objective_total - $allocatedMarks }}
            </div>

            @if (\Illuminate\Support\Facades\DB::table('examination_attempts')->where('examination_id', $examination->id)->exists())
                <div class="text-danger small mt-2">
                    Students have already attempted this examination. Its scoring structure cannot be changed.
                    Its class and department are also locked.
                </div>
            @endif
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

                    <select name="school_class_id"
                            id="school_class_id"
                            class="form-select"
                            required>

                        <option value="">Select class</option>

                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                @selected(old('school_class_id', $examination->school_class_id) == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- DEPARTMENT SELECTION -->

                <div class="col-md-6"
                     id="department-container"
                     style="display: none;">

                    <label class="form-label">
                        Examination Department
                    </label>

                    <select name="department"
                            id="department"
                            class="form-select">

                        <option value="">
                            General Examination (All Departments)
                        </option>

                        @foreach ($departments as $department)
                            <option value="{{ $department }}"
                                @selected(old('department', $examination->department) == $department)>
                                {{ $department }}
                            </option>
                        @endforeach

                    </select>

                    <div class="department-note">
                        Leave this as General Examination for subjects shared
                        by all departments. Select Science, Arts or Commercial
                        for a subject specific to that department.
                    </div>

                </div>

                <div class="col-md-6">
                    <label class="form-label">Academic Year</label>

                    <input type="text"
                           name="academic_year"
                           class="form-control"
                           value="{{ old('academic_year', $examination->academic_year) }}"
                           placeholder="2026/2027"
                           maxlength="20"
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

            <div class="score-note mb-4">
                <strong>Scoring configuration</strong>

                <p class="mb-0 mt-1">
                    CA, Objective and Theory maximum marks are added together
                    to calculate the examination total. For online examinations,
                    the objective questions must add up to the Objective Maximum Marks.
                </p>
            </div>

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
                    <label class="form-label">CA Maximum Marks</label>

                    <input type="number"
                           name="ca_total"
                           id="ca_total"
                           class="form-control component-mark"
                           min="0"
                           value="{{ old('ca_total', $examination->ca_total) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Objective Maximum Marks</label>

                    <input type="number"
                           name="objective_total"
                           id="objective_total"
                           class="form-control component-mark"
                           min="0"
                           value="{{ old('objective_total', $examination->objective_total) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Theory Maximum Marks</label>

                    <input type="number"
                           name="theory_total"
                           id="theory_total"
                           class="form-control component-mark"
                           min="0"
                           value="{{ old('theory_total', $examination->theory_total) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total Marks</label>

                    <input type="number"
                           name="total_marks"
                           id="total_marks"
                           class="form-control"
                           value="{{ old('total_marks', $examination->total_marks) }}"
                           readonly>

                    <div class="form-text">
                        Automatically calculated.
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Pass Mark</label>

                    <input type="number"
                           name="pass_mark"
                           id="pass_mark"
                           class="form-control"
                           min="0"
                           value="{{ old('pass_mark', $examination->pass_mark) }}"
                           required>

                    <div class="form-text">
                        Cannot exceed the total marks.
                    </div>
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

<script>
    // Show department selection only for senior secondary classes.

    const classSelect = document.getElementById('school_class_id');
    const departmentContainer = document.getElementById('department-container');
    const departmentSelect = document.getElementById('department');

    function updateDepartmentVisibility() {

        const selectedOption = classSelect.options[classSelect.selectedIndex];

        const selectedClass = selectedOption
            ? selectedOption.text.trim().toUpperCase()
            : '';

        const isSeniorSecondary = selectedClass.startsWith('SS');

        if (isSeniorSecondary) {

            departmentContainer.style.display = 'block';
            departmentSelect.disabled = false;

        } else {

            departmentContainer.style.display = 'none';
            departmentSelect.value = '';
            departmentSelect.disabled = true;

        }
    }

    classSelect.addEventListener('change', updateDepartmentVisibility);

    // Run when the page loads.
    updateDepartmentVisibility();


    // Automatic examination total calculation.

    const caTotal = document.getElementById('ca_total');
    const objectiveTotal = document.getElementById('objective_total');
    const theoryTotal = document.getElementById('theory_total');

    const totalMarks = document.getElementById('total_marks');
    const passMark = document.getElementById('pass_mark');

    function calculateTotalMarks() {

        const ca = Number(caTotal.value) || 0;
        const objective = Number(objectiveTotal.value) || 0;
        const theory = Number(theoryTotal.value) || 0;

        const total = ca + objective + theory;

        totalMarks.value = total;
        passMark.max = total;

        if (Number(passMark.value) > total) {
            passMark.value = total;
        }
    }

    document.querySelectorAll('.component-mark').forEach(input => {
        input.addEventListener('input', calculateTotalMarks);
    });

    calculateTotalMarks();
</script>

</body>
</html>
