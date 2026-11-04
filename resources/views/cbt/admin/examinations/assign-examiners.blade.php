
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Examiners | Excellent Leaders CBT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --background: #F3F7F8;
        }

        body {
            background: var(--background);
            font-family: Arial, sans-serif;
            color: #263746;
        }

        .topbar {
            background: var(--navy);
            color: white;
            padding: 22px 0;
        }

        .page-container {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 15px;
        }

        .panel {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
            margin-bottom: 22px;
        }

        .section-title {
            color: var(--navy);
            font-weight: 700;
        }

        .exam-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 18px;
        }

        .info-label {
            color: #77838c;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            color: var(--navy);
        }

        .examiner-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 17px;
            border: 1px solid #e5eaed;
            border-radius: 9px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: 0.2s;
        }

        .examiner-item:hover {
            border-color: var(--gold);
            background: #fffdf8;
        }

        .examiner-item input {
            width: 19px;
            height: 19px;
            accent-color: var(--navy);
        }

        .examiner-name {
            font-weight: 700;
            color: var(--navy);
        }

        .examiner-email {
            font-size: 13px;
            color: #77838c;
        }

        .btn-primary-custom {
            background: var(--navy);
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 7px;
        }

        .btn-primary-custom:hover {
            background: var(--blue);
            color: white;
        }

        .btn-back {
            color: var(--navy);
            border: 1px solid var(--navy);
            padding: 10px 18px;
            border-radius: 7px;
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--navy);
            color: white;
        }

        .gold-line {
            width: 55px;
            height: 4px;
            background: var(--gold);
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="container">
        <h4 class="mb-1">EXCELLENT LEADERS SECONDARY SCHOOL</h4>
        <small>CBT Examination Management System</small>
    </div>
</header>

<main class="page-container">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="section-title mb-1">Assign Examiners</h3>
            <p class="text-muted mb-0">
                Manage the examiners responsible for this examination.
            </p>
            <div class="gold-line"></div>
        </div>

        <a href="{{ route('cbt.admin.examinations.index') }}" class="btn-back">
            Back to Examinations
        </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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


    <!-- Examination Details -->
    <section class="panel">

        <h5 class="section-title mb-4">Examination Details</h5>

        <div class="exam-info">

            <div>
                <div class="info-label">Examination</div>
                <div class="info-value">{{ $examination->title }}</div>
            </div>

            <div>
                <div class="info-label">Subject</div>
                <div class="info-value">{{ $examination->subject }}</div>
            </div>

            <div>
                <div class="info-label">Class</div>
                <div class="info-value">
                    {{ $examination->schoolClass->name ?? 'Not available' }}
                </div>
            </div>

            <div>
                <div class="info-label">Academic Year</div>
                <div class="info-value">{{ $examination->academic_year }}</div>
            </div>

            <div>
                <div class="info-label">Term</div>
                <div class="info-value">{{ $examination->term }}</div>
            </div>

            <div>
                <div class="info-label">Assigned Examiners</div>
                <div class="info-value">{{ $assignedExaminers->count() }}</div>
            </div>

        </div>

    </section>


    <!-- Examiner Assignment Form -->
    <section class="panel">

        <h5 class="section-title mb-2">Select Examiners</h5>

        <p class="text-muted mb-4">
            Select all examiners who should have access to this examination.
            Unselecting an examiner will remove their assignment.
        </p>

        <form
            method="POST"
            action="{{ route('cbt.admin.examinations.examiners.update', $examination) }}"
        >

            @csrf
            @method('PUT')

            @php
                $selectedExaminerIds = old(
                    'examiner_ids',
                    $assignedExaminers->pluck('id')->all()
                );
            @endphp


            @forelse($examiners as $examiner)

                <label class="examiner-item">

                    <input
                        type="checkbox"
                        name="examiner_ids[]"
                        value="{{ $examiner->id }}"
                        {{ in_array($examiner->id, $selectedExaminerIds) ? 'checked' : '' }}
                    >

                    <div>
                        <div class="examiner-name">
                            {{ $examiner->name }}
                        </div>

                        <div class="examiner-email">
                            {{ $examiner->email }}
                        </div>
                    </div>

                    @if($assignedExaminers->contains('id', $examiner->id))
                        <span class="badge bg-success ms-auto">
                            Currently Assigned
                        </span>
                    @endif

                </label>

            @empty

                <div class="alert alert-warning">
                    There are currently no active examiners available.
                    Create or activate an examiner account before assigning one.
                </div>

            @endforelse


            @if($examiners->isNotEmpty())

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

                    <small class="text-muted">
                        Changes will take effect after saving.
                    </small>

                    <button type="submit" class="btn-primary-custom">
                        Save Examiner Assignments
                    </button>

                </div>

            @endif

        </form>

    </section>

</main>

</body>
</html>
