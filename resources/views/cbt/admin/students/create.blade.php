<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: #243746;
        }

        .header {
            background: var(--navy);
            color: white;
            padding: 22px 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 23px;
        }

        .header p {
            margin: 7px 0 0;
            color: #dce7ec;
            font-size: 14px;
        }

        .container {
            max-width: 950px;
            margin: 30px auto;
            padding: 0 18px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: var(--blue);
            text-decoration: none;
            font-weight: bold;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 18px rgba(23, 59, 77, 0.07);
        }

        .card h2 {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 22px;
        }

        .intro {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .section-title {
            margin: 28px 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            color: var(--navy);
            font-size: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: white;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: 2px solid #b8d0dc;
            border-color: var(--blue);
        }

        .help-text {
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .error-box {
            background: #fff1f2;
            color: #9f1239;
            border: 1px solid #fecdd3;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            display: inline-block;
            border: 0;
            border-radius: 7px;
            padding: 13px 19px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .primary-button {
            background: var(--navy);
            color: white;
        }

        .primary-button:hover {
            background: var(--blue);
        }

        .secondary-button {
            background: #e8eef1;
            color: var(--navy);
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .card {
                padding: 20px;
            }

            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <h1>Abu Haneefah Islamic Academy</h1>
        <p>CBT Administration Portal</p>
    </header>

    <main class="container">
        <a href="{{ route('cbt.admin.students.index') }}" class="back-link">
            &larr; Back to Student Management
        </a>

        <section class="card">
            <h2>Register New Student</h2>

            <p class="intro">
                Enter the student's details below. The system will generate
                an admission number and a temporary login password after
                the form is submitted successfully.
            </p>

            @if ($errors->any())
                <div class="error-box">
                    <strong>Please correct the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('cbt.admin.students.store') }}"
                method="POST"
            >
                @csrf

                <h3 class="section-title">Student Information</h3>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            maxlength="100"
                            autocomplete="given-name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            maxlength="100"
                            autocomplete="family-name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="other_names">Other Names</label>
                        <input
                            type="text"
                            id="other_names"
                            name="other_names"
                            value="{{ old('other_names') }}"
                            maxlength="100"
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Student Email Address *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            autocomplete="email"
                            required
                        >
                        <span class="help-text">
                            Each student account must have a unique email address.
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="school_class_id">Class *</label>
                        <select
                            id="school_class_id"
                            name="school_class_id"
                            required
                        >
                            <option value="">Select class</option>

                            @foreach ($classes as $class)
                                <option
                                    value="{{ $class->id }}"
                                    @selected(old('school_class_id') == $class->id)
                                >
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input
                            type="date"
                            id="date_of_birth"
                            name="date_of_birth"
                            value="{{ old('date_of_birth') }}"
                            max="{{ now()->toDateString() }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="Male" @selected(old('gender') === 'Male')>
                                Male
                            </option>
                            <option value="Female" @selected(old('gender') === 'Female')>
                                Female
                            </option>
                        </select>
                    </div>
                </div>

                <h3 class="section-title">Parent or Guardian Information</h3>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="guardian_name">Guardian's Full Name</label>
                        <input
                            type="text"
                            id="guardian_name"
                            name="guardian_name"
                            value="{{ old('guardian_name') }}"
                            maxlength="255"
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label for="guardian_phone">Guardian's Phone Number</label>
                        <input
                            type="tel"
                            id="guardian_phone"
                            name="guardian_phone"
                            value="{{ old('guardian_phone') }}"
                            maxlength="30"
                            autocomplete="tel"
                        >
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="button primary-button">
                        Register Student
                    </button>

                    <a
                        href="{{ route('cbt.admin.students.index') }}"
                        class="button secondary-button"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>

</body>
</html>