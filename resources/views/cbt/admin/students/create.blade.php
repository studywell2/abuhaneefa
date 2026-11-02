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
            --text: #243746;
            --muted: #718096;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 20%, rgba(49, 92, 114, .15), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(214, 168, 79, .14), transparent 30%),
                var(--background);
            overflow-x: hidden;
        }

        /* Animated background */

        .background-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(2px);
            opacity: .35;
            pointer-events: none;
            animation: float 9s ease-in-out infinite;
            z-index: -1;
        }

        .shape-one {
            width: 230px;
            height: 230px;
            background: #315C72;
            top: 8%;
            left: -90px;
        }

        .shape-two {
            width: 180px;
            height: 180px;
            background: #D6A84F;
            bottom: 5%;
            right: -60px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25px);
            }
        }

        /* Header */

        .header {
            text-align: center;
            padding: 30px 20px 10px;
            animation: fadeDown .8s ease;
        }

        .header h1 {
            margin: 0;
            color: var(--navy);
            font-size: 25px;
            font-weight: 800;
        }

        .header p {
            margin: 8px 0 0;
            color: var(--blue);
            font-size: 14px;
        }

        /* Main container */

        .container {
            max-width: 850px;
            margin: 20px auto 50px;
            padding: 0 18px;
            animation: fadeUp .8s ease;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: var(--blue);
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: .3s;
        }

        .back-link:hover {
            color: var(--gold);
            transform: translateX(-4px);
        }

        /* Main card */

        .card {
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 15px 45px rgba(23, 59, 77, .12);
        }

        .card-heading {
            text-align: center;
            margin-bottom: 25px;
        }

        .card-heading h2 {
            margin: 0;
            color: var(--navy);
            font-size: 25px;
        }

        .card-heading p {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Progress */

        .progress-area {
            margin-bottom: 28px;
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: bold;
            color: var(--muted);
        }

        .progress-labels span.active {
            color: var(--navy);
        }

        .progress-track {
            height: 6px;
            background: #e5edf0;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 50%;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            border-radius: 20px;
            transition: width .6s ease;
        }

        /* Error message */

        .error-box {
            background: #fff1f2;
            color: #9f1239;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* Flip form */

        .flip-container {
            perspective: 1200px;
        }

        .flip-inner {
            display: grid;
            transform-style: preserve-3d;
            transition: transform .75s cubic-bezier(.2, .75, .25, 1);
        }

        .flip-inner.flipped {
            transform: rotateY(180deg);
        }

        .flip-face {
            grid-area: 1 / 1;
            width: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .flip-back {
            transform: rotateY(180deg);
        }

        /* Section headings */

        .section-title {
            color: var(--navy);
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            margin: -8px 0 22px;
        }

        /* Form fields */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
            animation: fieldAppear .55s ease both;
        }

        .form-group:nth-child(1) { animation-delay: .05s; }
        .form-group:nth-child(2) { animation-delay: .10s; }
        .form-group:nth-child(3) { animation-delay: .15s; }
        .form-group:nth-child(4) { animation-delay: .20s; }
        .form-group:nth-child(5) { animation-delay: .25s; }
        .form-group:nth-child(6) { animation-delay: .30s; }
        .form-group:nth-child(7) { animation-delay: .35s; }

        @keyframes fieldAppear {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            color: var(--navy);
            font-size: 13px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #d5e0e5;
            border-radius: 9px;
            background: rgba(255, 255, 255, .9);
            color: var(--text);
            font-size: 14px;
            font-family: inherit;
            transition: border-color .3s, box-shadow .3s, transform .3s;
        }

        input:hover,
        select:hover {
            border-color: var(--blue);
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(49, 92, 114, .12);
            transform: translateY(-2px);
        }

        input::placeholder {
            color: #a0acb5;
        }

        .help-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        /* Buttons */

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border: none;
            border-radius: 9px;
            padding: 14px 22px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: .3s ease;
        }

        .primary-button {
            background: linear-gradient(135deg, var(--navy), var(--blue));
            color: white;
            box-shadow: 0 6px 15px rgba(23, 59, 77, .18);
        }

        .primary-button:hover {
            background: linear-gradient(135deg, var(--blue), var(--navy));
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(23, 59, 77, .22);
        }

        .secondary-button {
            background: #e8eef1;
            color: var(--navy);
        }

        .secondary-button:hover {
            background: #dce7ec;
            transform: translateY(-2px);
        }

        .button:active {
            transform: scale(.97);
        }

        .footer-note {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 25px;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile */

        @media (max-width: 600px) {
            .header h1 {
                font-size: 21px;
            }

            .container {
                margin-top: 12px;
            }

            .card {
                padding: 22px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .button {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <div class="background-shape shape-one"></div>
    <div class="background-shape shape-two"></div>

    <header class="header">
        <h1>Abu Haneefah Islamic Academy</h1>
        <p>CBT Administration Portal</p>
    </header>

    <main class="container">

        <a href="{{ route('cbt.admin.students.index') }}" class="back-link">
            &larr; Back to Student Management
        </a>

        <section class="card">

            <div class="card-heading">
                <h2>Register New Student</h2>

                <p>
                    Enter the student's details below. The system will generate
                    an admission number and a temporary login password after
                    successful registration.
                </p>
            </div>

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

            <div class="progress-area">
                <div class="progress-labels">
                    <span id="stepOneLabel" class="active">
                        01 — Student Information
                    </span>

                    <span id="stepTwoLabel">
                        02 — Guardian Information
                    </span>
                </div>

                <div class="progress-track">
                    <div class="progress-bar" id="progressBar"></div>
                </div>
            </div>

            <form
                id="studentRegistrationForm"
                action="{{ route('cbt.admin.students.store') }}"
                method="POST"
            >
                @csrf

                <div class="flip-container">

                    <div class="flip-inner" id="flipInner">

                        {{-- PAGE ONE: STUDENT INFORMATION --}}

                        <div class="flip-face flip-front">

                            <h3 class="section-title">
                                Student Information
                            </h3>

                            <p class="section-description">
                                Provide the student's personal and academic details.
                            </p>

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
                                        placeholder="Enter first name"
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
                                        placeholder="Enter last name"
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
                                        placeholder="Enter other names"
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
                                        placeholder="Enter email address"
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

                                        <option
                                            value="Male"
                                            @selected(old('gender') === 'Male')
                                        >
                                            Male
                                        </option>

                                        <option
                                            value="Female"
                                            @selected(old('gender') === 'Female')
                                        >
                                            Female
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <div class="actions">
                                <a
                                    href="{{ route('cbt.admin.students.index') }}"
                                    class="button secondary-button"
                                >
                                    Cancel
                                </a>

                                <button
                                    type="button"
                                    class="button primary-button"
                                    id="continueButton"
                                >
                                    Continue &rarr;
                                </button>
                            </div>

                        </div>


                        {{-- PAGE TWO: GUARDIAN INFORMATION --}}

                        <div class="flip-face flip-back">

                            <h3 class="section-title">
                                Parent or Guardian Information
                            </h3>

                            <p class="section-description">
                                Provide the contact details of the student's parent or guardian.
                            </p>

                            <div class="form-grid">

                                <div class="form-group full-width">
                                    <label for="guardian_name">
                                        Guardian's Full Name
                                    </label>

                                    <input
                                        type="text"
                                        id="guardian_name"
                                        name="guardian_name"
                                        value="{{ old('guardian_name') }}"
                                        maxlength="255"
                                        autocomplete="off"
                                        placeholder="Enter guardian's full name"
                                    >
                                </div>

                                <div class="form-group full-width">
                                    <label for="guardian_phone">
                                        Guardian's Phone Number
                                    </label>

                                    <input
                                        type="tel"
                                        id="guardian_phone"
                                        name="guardian_phone"
                                        value="{{ old('guardian_phone') }}"
                                        maxlength="30"
                                        autocomplete="tel"
                                        placeholder="Enter guardian's phone number"
                                    >
                                </div>

                            </div>

                            <div class="actions">

                                <button
                                    type="button"
                                    class="button secondary-button"
                                    id="backButton"
                                >
                                    &larr; Go Back
                                </button>

                                <button
                                    type="submit"
                                    class="button primary-button"
                                >
                                    Register Student &#10003;
                                </button>

                            </div>

                        </div>

                    </div>
                </div>

            </form>

            <div class="footer-note">
                Abu Haneefah Islamic Academy &copy; {{ date('Y') }}
            </div>

        </section>

    </main>


    <script>
        const form = document.getElementById('studentRegistrationForm');
        const flipInner = document.getElementById('flipInner');

        const continueButton = document.getElementById('continueButton');
        const backButton = document.getElementById('backButton');

        const progressBar = document.getElementById('progressBar');

        const stepOneLabel = document.getElementById('stepOneLabel');
        const stepTwoLabel = document.getElementById('stepTwoLabel');

        let currentStep = 1;

        function validateStudentInformation() {

            const firstPage = document.querySelector('.flip-front');

            const fields = firstPage.querySelectorAll(
                'input[required], select[required]'
            );

            for (const field of fields) {

                if (!field.checkValidity()) {

                    field.reportValidity();

                    field.focus();

                    return false;
                }
            }

            return true;
        }

        function goToGuardianInformation() {

            if (!validateStudentInformation()) {
                return;
            }

            currentStep = 2;

            flipInner.classList.add('flipped');

            progressBar.style.width = '100%';

            stepOneLabel.classList.remove('active');
            stepTwoLabel.classList.add('active');

        }

        function goToStudentInformation() {

            currentStep = 1;

            flipInner.classList.remove('flipped');

            progressBar.style.width = '50%';

            stepTwoLabel.classList.remove('active');
            stepOneLabel.classList.add('active');

        }

        continueButton.addEventListener('click', function () {
            goToGuardianInformation();
        });

        backButton.addEventListener('click', function () {
            goToStudentInformation();
        });

        form.addEventListener('submit', function (event) {

            if (currentStep === 1) {

                event.preventDefault();

                goToGuardianInformation();

            }

        });
    </script>

</body>
</html>