
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add School Class | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #F3F7F8;
            color: #243746;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #173B4D;
            color: #fff;
            padding: 18px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .school-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
        }

        .school-brand h2 {
            margin: 0 0 5px;
            font-size: 18px;
        }

        .school-brand p {
            margin: 0;
            font-size: 12px;
            color: #dce7eb;
        }

        .back-link {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
        }

        .container {
            max-width: 850px;
            margin: 38px auto;
            padding: 0 20px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin: 0 0 8px;
            color: #173B4D;
            font-size: 27px;
        }

        .page-heading p {
            margin: 0;
            color: #718096;
            font-size: 14px;
        }

        .panel {
            background: #fff;
            border: 1px solid #e3eaee;
            border-radius: 9px;
            padding: 28px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #173B4D;
            font-size: 13px;
            font-weight: 700;
        }

        .required {
            color: #bd4141;
        }

        input, select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dce4e8;
            border-radius: 6px;
            font-size: 14px;
            color: #243746;
            background: #fff;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #315C72;
            box-shadow: 0 0 0 3px rgba(49, 92, 114, .1);
        }

        .hint {
            display: block;
            margin-top: 7px;
            color: #718096;
            font-size: 12px;
        }

        .error {
            margin-top: 6px;
            color: #bd4141;
            font-size: 12px;
        }

        .status-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px;
            background: #f8fafb;
            border: 1px solid #e3eaee;
            border-radius: 7px;
        }

        .status-box input {
            width: auto;
            margin: 0;
        }

        .status-box label {
            margin: 0;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .btn {
            display: inline-block;
            padding: 12px 19px;
            border: none;
            border-radius: 6px;
            background: #315C72;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn:hover {
            background: #173B4D;
        }

        .btn-secondary {
            background: #edf1f3;
            color: #34495e;
        }

        .btn-secondary:hover {
            background: #dce4e8;
        }

        @media (max-width: 650px) {
            .topbar {
                padding: 15px 20px;
            }

            .school-brand h2 {
                font-size: 14px;
            }

            .school-brand p {
                font-size: 10px;
            }

            .school-brand img {
                width: 40px;
                height: 40px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .panel {
                padding: 20px;
            }

            .page-heading h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="school-brand">
        <img src="{{ asset('images/logo.jpg') }}" alt="School Logo">

        <div>
            <h2>Abu Haneefah Islamic Academy</h2>
            <p>CBT Portal · Administration</p>
        </div>
    </div>

    <a href="{{ route('cbt.admin.classes.index') }}" class="back-link">
        ← Back to Classes
    </a>
</header>

<main class="container">

    <div class="page-heading">
        <h1>Add New School Class</h1>
        <p>Select the class level and provide its department where applicable.</p>
    </div>

    <section class="panel">

        <form action="{{ route('cbt.admin.classes.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label for="grade">
                        Class Level <span class="required">*</span>
                    </label>

                    <select id="grade" name="grade" required>
                        <option value="">Select class level</option>

                        @foreach(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3'] as $grade)
                            <option
                                value="{{ $grade }}"
                                {{ old('grade') == $grade ? 'selected' : '' }}
                            >
                                {{ $grade }}
                            </option>
                        @endforeach
                    </select>

                    <small class="hint">
                        Select JSS1–JSS3 or SS1–SS3.
                    </small>

                    @error('grade')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="form-group"
                    id="department-group"
                    style="display: none;"
                >
                    <label for="department">
                        Department <span class="required">*</span>
                    </label>

                    <select id="department" name="department" disabled>
                        <option value="">Select department</option>

                        @foreach(['Science', 'Arts', 'Commercial'] as $department)
                            <option
                                value="{{ $department }}"
                                {{ old('department') == $department ? 'selected' : '' }}
                            >
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

                <div class="form-group full">
                    <div class="status-box">

                        <input
                            type="hidden"
                            name="is_active"
                            value="0"
                        >

                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                        >

                        <label for="is_active">
                            Make this class active immediately
                        </label>

                    </div>

                    <small class="hint">
                        Active classes can be selected during student registration
                        and examination creation.
                    </small>

                    @error('is_active')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="actions">

                <button type="submit" class="btn">
                    Save Class
                </button>

                <a
                    href="{{ route('cbt.admin.classes.index') }}"
                    class="btn btn-secondary"
                >
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
