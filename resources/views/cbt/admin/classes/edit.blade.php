
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit School Class | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #F3F7F8;
            color: #243746;
        }

        .topbar {
            background: #173B4D;
            color: white;
            padding: 18px 30px;
        }

        .topbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .container {
            max-width: 850px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .back-link {
            display: inline-block;
            color: #315C72;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e3eaee;
        }

        h1 {
            margin-top: 0;
            color: #173B4D;
            font-size: 25px;
        }

        .description {
            color: #718096;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .required {
            color: #bd4141;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd7dd;
            border-radius: 6px;
            font-size: 15px;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #315C72;
        }

        select optgroup {
            color: #173B4D;
            font-weight: bold;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-row input {
            width: auto;
        }

        .checkbox-row label {
            margin: 0;
        }

        .error {
            color: #bd4141;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert {
            background: #fff0f0;
            color: #bd4141;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .hint {
            display: block;
            color: #718096;
            font-size: 12px;
            margin-top: 7px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #173B4D;
            color: white;
        }

        .btn-secondary {
            background: #e8eef1;
            color: #315C72;
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 16px 20px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <h2>Abu Haneefah Islamic Academy</h2>
</header>

<main class="container">

    <a href="{{ route('cbt.admin.classes.index') }}" class="back-link">
        &larr; Back to School Classes
    </a>

    <section class="card">

        <h1>Edit School Class</h1>

        <p class="description">
            Update the class level, department and activation status.
        </p>

        @if ($errors->any())
            <div class="alert">
                Please correct the errors below before submitting.
            </div>
        @endif

        @php
            $currentName = $schoolClass->name;

            $grades = [
                'Pry 1', 'Pry 2', 'Pry 3', 'Pry 4', 'Pry 5', 'Pry 6',
                'JSS1', 'JSS2', 'JSS3',
                'SS1', 'SS2', 'SS3',
                'Ibtidaaiyah', 'Idaadiyah', 'Thanawiyah',
            ];

            $currentGrade = $currentName;

            foreach (['Science', 'Arts', 'Commercial'] as $departmentName) {
                if (str_ends_with($currentName, ' ' . $departmentName)) {
                    $currentGrade = substr(
                        $currentName,
                        0,
                        -strlen(' ' . $departmentName)
                    );
                    break;
                }
            }
        @endphp

        <form action="{{ route('cbt.admin.classes.update', $schoolClass) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="grade">
                    Class Level <span class="required">*</span>
                </label>

                <select id="grade" name="grade" required>
                    <option value="">Select class level</option>

                    <optgroup label="Primary">
                        @foreach (['Pry 1', 'Pry 2', 'Pry 3', 'Pry 4', 'Pry 5', 'Pry 6'] as $grade)
                            <option value="{{ $grade }}"
                                {{ old('grade', $currentGrade) === $grade ? 'selected' : '' }}>
                                {{ $grade }}
                            </option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Junior Secondary">
                        @foreach (['JSS1', 'JSS2', 'JSS3'] as $grade)
                            <option value="{{ $grade }}"
                                {{ old('grade', $currentGrade) === $grade ? 'selected' : '' }}>
                                {{ $grade }}
                            </option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Senior Secondary">
                        @foreach (['SS1', 'SS2', 'SS3'] as $grade)
                            <option value="{{ $grade }}"
                                {{ old('grade', $currentGrade) === $grade ? 'selected' : '' }}>
                                {{ $grade }}
                            </option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Islamic Studies">
                        @foreach (['Ibtidaaiyah', 'Idaadiyah', 'Thanawiyah'] as $grade)
                            <option value="{{ $grade }}"
                                {{ old('grade', $currentGrade) === $grade ? 'selected' : '' }}>
                                {{ $grade }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>

                @error('grade')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="department-group" style="display: none;">
                <label for="department">
                    Department <span class="required">*</span>
                </label>

                <select id="department" name="department" disabled>
                    <option value="">Select department</option>

                    @foreach (['Science', 'Arts', 'Commercial'] as $department)
                        <option value="{{ $department }}"
                            {{ old('department', $schoolClass->arm) === $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>

                <small class="hint">
                    Select the department for this senior secondary class.
                </small>

                @error('department')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-row">

                    <input type="hidden" name="is_active" value="0">

                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $schoolClass->is_active) ? 'checked' : '' }}
                    >

                    <label for="is_active">Class is active</label>

                </div>

                @error('is_active')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="buttons">

                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>

                <a href="{{ route('cbt.admin.classes.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </section>

</main>

<script>
    const gradeSelect = document.getElementById('grade');
    const departmentGroup = document.getElementById('department-group');
    const departmentSelect = document.getElementById('department');

    function updateDepartmentField() {
        const grade = gradeSelect.value;
        const isSenior = ['SS1', 'SS2', 'SS3'].includes(grade);

        departmentGroup.style.display = isSenior ? 'block' : 'none';
        departmentSelect.disabled = !isSenior;
        departmentSelect.required = isSenior;

        if (!isSenior) {
            departmentSelect.value = '';
        }
    }

    gradeSelect.addEventListener('change', updateDepartmentField);

    updateDepartmentField();
</script>

</body>
</html>
