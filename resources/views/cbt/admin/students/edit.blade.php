
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Abu Haneefah Islamic Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            background: #f3f6fa;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #173b5e;
            color: white;
            padding: 20px 5%;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 8px;
            padding: 4px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 19px;
        }

        .topbar p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #d8e4ef;
        }

        .container {
            max-width: 950px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .page-heading h2 {
            margin: 0 0 7px;
            font-size: 25px;
        }

        .page-heading p {
            margin: 0;
            color: #68778b;
            font-size: 14px;
        }

        .back-link {
            color: #173b5e;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 18px rgba(20, 45, 75, .06);
            margin-bottom: 22px;
        }

        .card h3 {
            margin: 0 0 20px;
            font-size: 17px;
            border-bottom: 1px solid #e8edf3;
            padding-bottom: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: bold;
            color: #34445a;
        }

        input, select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 13px;
            border: 1px solid #d7e0ea;
            border-radius: 7px;
            font-size: 14px;
            background: white;
            color: #24364b;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #315c72;
            box-shadow: 0 0 0 3px rgba(49, 92, 114, .12);
        }

        .error {
            color: #c62828;
            font-size: 12px;
        }

        .notice {
            padding: 13px 15px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .notice.success {
            background: #e8f6ed;
            color: #216b3b;
        }

        .notice.error-box {
            background: #fff0f0;
            color: #a12626;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #173b5e;
            color: white;
        }

        .btn-primary:hover {
            background: #245477;
        }

        .btn-secondary {
            background: #e9eef4;
            color: #34445a;
        }

        .required {
            color: #c62828;
        }

        .help-text {
            color: #78879a;
            font-size: 12px;
            line-height: 1.5;
        }

        @media (max-width: 650px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header class="topbar">
    <img src="{{ asset('images/logo.jpg') }}" alt="School Logo">
    <div>
        <h1>Abu Haneefah Islamic Academy</h1>
        <p>CBT Management Portal</p>
    </div>
</header>

<main class="container">

    <div class="page-heading">
        <div>
            <h2>Edit Student Information</h2>
            <p>Update the student's personal and account information.</p>
        </div>

        <a href="{{ route('cbt.admin.students.show', $student) }}" class="back-link">
            ← Back to Student Profile
        </a>
    </div>

    @if(session('success'))
        <div class="notice success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="notice error-box">
            <strong>Please correct the following errors:</strong>
            <ul style="margin: 8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cbt.admin.students.update', $student) }}"
          method="POST">

        @csrf
        @method('PUT')

        <section class="card">
            <h3>Student Information</h3>

            <div class="form-grid">

                <div class="form-group">
                    <label for="first_name">First Name <span class="required">*</span></label>
                    <input type="text" id="first_name" name="first_name"
                           value="{{ old('first_name', $student->first_name) }}"
                           required>
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name <span class="required">*</span></label>
                    <input type="text" id="last_name" name="last_name"
                           value="{{ old('last_name', $student->last_name) }}"
                           required>
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="other_names">Other Names</label>
                    <input type="text" id="other_names" name="other_names"
                           value="{{ old('other_names', $student->other_names) }}">
                    @error('other_names')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="admission_number">Admission Number</label>
                    <input type="text" id="admission_number"
                           value="{{ $student->admission_number }}"
                           disabled>
                    <small class="help-text">
                        Admission number cannot be changed here.
                    </small>
                </div>

                <div class="form-group">
                    <label for="school_class_id">Class <span class="required">*</span></label>

                    <select name="school_class_id" id="school_class_id" required>
                        <option value="">Select class</option>

                        @foreach($classes as $class)
                            <option
                                value="{{ $class->id }}"
                                data-class-name="{{ $class->name }}"
                                {{ (string) old('school_class_id', $student->school_class_id) === (string) $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('school_class_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" id="departmentGroup" style="display:none;">
                    <label for="department">Department <span class="required">*</span></label>

                    <select name="department" id="department" disabled>
                        <option value="">Select department</option>

                        <option value="Science"
                            {{ old('department', $student->department) === 'Science' ? 'selected' : '' }}>
                            Science
                        </option>

                        <option value="Arts"
                            {{ old('department', $student->department) === 'Arts' ? 'selected' : '' }}>
                            Arts
                        </option>

                        <option value="Commercial"
                            {{ old('department', $student->department) === 'Commercial' ? 'selected' : '' }}>
                            Commercial
                        </option>
                    </select>

                    <span class="help-text">
                        Required for Senior Secondary students only.
                    </span>

                    @error('department')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                           value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}">
                    @error('date_of_birth')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="">Select gender</option>

                        <option value="Male"
                            {{ old('gender', $student->gender) === 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ old('gender', $student->gender) === 'Female' ? 'selected' : '' }}>
                            Female
                        </option>
                    </select>

                    @error('gender')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </section>

        <section class="card">
            <h3>Account Information</h3>

            <div class="form-grid">
                <div class="form-group full">
                    <label for="email">Email Address <span class="required">*</span></label>

                    <input type="email" id="email" name="email"
                           value="{{ old('email', $student->user?->email) }}"
                           required>

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <section class="card">
            <h3>Parent / Guardian Information</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="guardian_name">Guardian Name</label>
                    <input type="text" id="guardian_name" name="guardian_name"
                           value="{{ old('guardian_name', $student->guardian_name) }}">
                    @error('guardian_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="guardian_phone">Guardian Phone Number</label>
                    <input type="text" id="guardian_phone" name="guardian_phone"
                           value="{{ old('guardian_phone', $student->guardian_phone) }}">
                    @error('guardian_phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('cbt.admin.students.show', $student) }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
            </div>
        </section>

    </form>

</main>

<script>
    const classSelect = document.getElementById('school_class_id');
    const departmentGroup = document.getElementById('departmentGroup');
    const departmentSelect = document.getElementById('department');

    function updateDepartmentField() {
        const selectedOption = classSelect.options[classSelect.selectedIndex];

        const className = selectedOption
            ? selectedOption.dataset.className || ''
            : '';

        const isSeniorSecondary = /^SS[1-3](?:\s|$)/i.test(className.trim());

        departmentGroup.style.display = isSeniorSecondary ? 'flex' : 'none';
        departmentSelect.disabled = !isSeniorSecondary;
        departmentSelect.required = isSeniorSecondary;

        if (!isSeniorSecondary) {
            departmentSelect.value = '';
        }
    }

    classSelect.addEventListener('change', updateDepartmentField);

    updateDepartmentField();
</script>

</body>
</html>
