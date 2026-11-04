
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Examination | Abuhaneefah Islamic Academy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        :root {
            --green: #244C40;
            --green-dark: #193B32;
            --cream: #F7F6F1;
            --gold: #B89A58;
            --border: #E5E8E3;
            --muted: #78847D;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: #293832;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
        }

        .topbar {
            background: var(--green-dark);
            color: white;
            padding: 17px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 15px;
            font-weight: 650;
        }

        .brand small {
            display: block;
            color: #D7BE83;
            font-size: 10px;
            margin-top: 4px;
            letter-spacing: 1px;
        }

        .topbar a {
            color: white;
            text-decoration: none;
            font-size: 12px;
        }

        .page-container {
            max-width: 1050px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .breadcrumb {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 15px;
        }

        .breadcrumb a {
            color: var(--green);
            text-decoration: none;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 15px;
        }

        .page-heading h1 {
            font-size: 23px;
            color: var(--green-dark);
            font-weight: 650;
            margin: 0 0 6px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
            margin: 0;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .panel-heading {
            padding: 17px 22px;
            border-bottom: 1px solid var(--border);
        }

        .panel-heading h5 {
            font-size: 14px;
            color: var(--green-dark);
            font-weight: 650;
            margin: 0;
        }

        .panel-heading p {
            font-size: 11px;
            color: var(--muted);
            margin: 5px 0 0;
        }

        .panel-body {
            padding: 24px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #47554C;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            min-height: 41px;
            font-size: 13px;
            border-color: #DDE3DE;
            border-radius: 4px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 2px rgba(36, 76, 64, .08);
        }

        .form-control[readonly] {
            background: #F0F3F0;
            font-weight: 700;
            color: var(--green-dark);
        }

        textarea.form-control {
            min-height: 105px;
        }

        .required {
            color: #B44C42;
        }

        .form-text {
            font-size: 11px;
            color: var(--muted);
        }

        .score-note {
            background: #F3F6F2;
            border: 1px solid var(--border);
            padding: 13px 15px;
            border-radius: 4px;
            font-size: 12px;
            color: #47554C;
            margin-bottom: 20px;
        }

        .department-note {
            background: #F3F6F2;
            border: 1px solid var(--border);
            padding: 11px 13px;
            border-radius: 4px;
            font-size: 11px;
            color: #47554C;
            margin-top: 9px;
        }

        .btn-save {
            background: var(--green);
            color: white;
            border: 1px solid var(--green);
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-save:hover {
            background: var(--green-dark);
            color: white;
        }

        .btn-cancel {
            background: white;
            color: #47554C;
            border: 1px solid var(--border);
            padding: 10px 18px;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            padding: 20px;
        }

        @media(max-width: 600px) {
            .topbar {
                padding: 15px;
            }

            .page-container {
                padding: 0 13px;
                margin-top: 20px;
            }

            .panel-body {
                padding: 17px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <header class="topbar">

        <div class="brand">
            ABUHANEEFA ISLAMIC ACADEMY
            <small>CBT MANAGEMENT PORTAL</small>
        </div>

        <a href="{{ route('cbt.admin.dashboard') }}">
            Administrator Dashboard
        </a>

    </header>


    <main class="page-container">

        <div class="breadcrumb">
            <a href="{{ route('cbt.admin.dashboard') }}">Dashboard</a>
            /
            <a href="{{ route('cbt.admin.examinations.index') }}">
                Examinations
            </a>
            /
            Create Examination
        </div>


        <div class="page-heading">

            <div>
                <h1>Create Examination</h1>

                <p>
                    Enter the examination details and configure its schedule.
                </p>
            </div>

            <a href="{{ route('cbt.admin.examinations.index') }}"
               class="btn-cancel">
                Back to Examinations
            </a>

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
              action="{{ route('cbt.admin.examinations.store') }}">

            @csrf


            <!-- BASIC INFORMATION -->

            <section class="panel">

                <div class="panel-heading">
                    <h5>Examination Information</h5>

                    <p>
                        Provide the basic information for this examination.
                    </p>
                </div>

                <div class="panel-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Examination Title <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title') }}"
                                   placeholder="e.g. First Term Examination"
                                   required>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Subject <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="subject"
                                   class="form-control"
                                   value="{{ old('subject') }}"
                                   placeholder="e.g. Mathematics"
                                   required>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Class <span class="required">*</span>
                            </label>

                            <select name="school_class_id"
                                    id="school_class_id"
                                    class="form-select"
                                    required>

                                <option value="">Select class</option>

                                @foreach ($classes as $class)

                                    <option value="{{ $class->id }}"
                                        {{ old('school_class_id') == $class->id ? 'selected' : '' }}>

                                        {{ $class->name }}

                                    </option>

                                @endforeach

                            </select>

                            @if ($classes->isEmpty())
                                <div class="form-text text-danger">
                                    No active classes are available. Add or activate a class first.
                                </div>
                            @endif

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
                                        {{ old('department') == $department ? 'selected' : '' }}>

                                        {{ $department }}

                                    </option>

                                @endforeach

                            </select>

                            <div class="department-note">
                                Leave this as General Examination for subjects
                                shared by all departments. Select a department
                                for subjects specific to Science, Arts or Commercial.
                            </div>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Academic Year <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="academic_year"
                                   class="form-control"
                                   value="{{ old('academic_year', '2026/2027') }}"
                                   placeholder="2026/2027"
                                   maxlength="20"
                                   required>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Academic Term <span class="required">*</span>
                            </label>

                            <select name="term"
                                    class="form-select"
                                    required>

                                <option value="">Select term</option>

                                <option value="First"
                                    {{ old('term') == 'First' ? 'selected' : '' }}>
                                    First Term
                                </option>

                                <option value="Second"
                                    {{ old('term') == 'Second' ? 'selected' : '' }}>
                                    Second Term
                                </option>

                                <option value="Third"
                                    {{ old('term') == 'Third' ? 'selected' : '' }}>
                                    Third Term
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Examination Mode <span class="required">*</span>
                            </label>

                            <select name="mode"
                                    class="form-select"
                                    required>

                                <option value="online"
                                    {{ old('mode', 'online') == 'online' ? 'selected' : '' }}>
                                    Online Examination
                                </option>

                                <option value="physical"
                                    {{ old('mode') == 'physical' ? 'selected' : '' }}>
                                    Physical Centre Examination
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </section>


            <!-- EXAMINATION CONFIGURATION -->

            <section class="panel">

                <div class="panel-heading">
                    <h5>Examination Configuration</h5>

                    <p>
                        Set the duration and maximum marks for each assessment component.
                    </p>
                </div>

                <div class="panel-body">

                    <div class="score-note">
                        <strong>Scoring structure:</strong>
                        Enter the maximum marks for CA, Objective and Theory.
                        The system will calculate the overall examination total automatically.
                        The three components must add up to a value greater than zero.
                    </div>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Duration (Minutes) <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="duration_minutes"
                                   class="form-control"
                                   min="1"
                                   value="{{ old('duration_minutes', 60) }}"
                                   required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                CA Maximum Marks <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="ca_total"
                                   id="ca_total"
                                   class="form-control component-mark"
                                   min="0"
                                   value="{{ old('ca_total', 40) }}"
                                   required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Objective Maximum Marks <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="objective_total"
                                   id="objective_total"
                                   class="form-control component-mark"
                                   min="0"
                                   value="{{ old('objective_total', 30) }}"
                                   required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Theory Maximum Marks <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="theory_total"
                                   id="theory_total"
                                   class="form-control component-mark"
                                   min="0"
                                   value="{{ old('theory_total', 30) }}"
                                   required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Total Marks
                            </label>

                            <input type="number"
                                   name="total_marks"
                                   id="total_marks"
                                   class="form-control"
                                   value="{{ old('total_marks', 100) }}"
                                   readonly>

                            <div class="form-text">
                                Automatically calculated.
                            </div>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Pass Mark <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="pass_mark"
                                   id="pass_mark"
                                   class="form-control"
                                   min="0"
                                   value="{{ old('pass_mark', 50) }}"
                                   required>

                            <div class="form-text">
                                Cannot exceed the total marks.
                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- SCHEDULE -->

            <section class="panel">

                <div class="panel-heading">
                    <h5>Examination Schedule</h5>

                    <p>
                        Scheduling is optional while preparing a draft examination.
                    </p>
                </div>

                <div class="panel-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Start Date and Time
                            </label>

                            <input type="datetime-local"
                                   name="start_time"
                                   class="form-control"
                                   value="{{ old('start_time') }}">

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                End Date and Time
                            </label>

                            <input type="datetime-local"
                                   name="end_time"
                                   class="form-control"
                                   value="{{ old('end_time') }}">

                        </div>

                    </div>

                </div>

            </section>


            <!-- INSTRUCTIONS -->

            <section class="panel">

                <div class="panel-heading">
                    <h5>Examination Instructions</h5>

                    <p>
                        Add any instructions students should follow.
                    </p>
                </div>

                <div class="panel-body">

                    <label class="form-label">
                        Instructions
                    </label>

                    <textarea name="instructions"
                              class="form-control"
                              placeholder="Enter examination instructions here...">{{ old('instructions') }}</textarea>

                    <div class="form-text mt-2">
                        You can leave this field empty and add instructions later.
                    </div>

                </div>

            </section>


            <!-- ACTIONS -->

            <div class="d-flex justify-content-end gap-2 mb-4">

                <a href="{{ route('cbt.admin.examinations.index') }}"
                   class="btn-cancel">
                    Cancel
                </a>

                <button type="submit"
                        class="btn-save"
                        {{ $classes->isEmpty() ? 'disabled' : '' }}>
                    Save Examination
                </button>

            </div>

        </form>


        <footer class="footer">
            © {{ date('Y') }} Abuhaneefah Islamic Academy.
            All rights reserved.
        </footer>

    </main>


    <script>
        // Department visibility based on selected class.

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

        // Run once when the page loads.
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
