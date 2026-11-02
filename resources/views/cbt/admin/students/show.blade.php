<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Profile | Abu Haneefah CBT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            background: #f3f7f8;
            font-family: Arial, sans-serif;
            color: #173B4D;
        }

        .student-profile {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .profile-header {
            background: #173B4D;
            color: #fff;
            padding: 28px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .profile-header h2 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .profile-header p {
            margin: 0;
            color: #d6e2e8;
        }

        .profile-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin-top: 22px;
        }

        .profile-card h3 {
            font-size: 18px;
            margin: 0 0 20px;
            color: #173B4D;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .detail-label {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .action-btn {
            display: inline-block;
            border: none;
            border-radius: 7px;
            padding: 10px 17px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-edit {
            background: #d6a84f;
            color: #173B4D;
        }

        .btn-status {
            background: #e0f2fe;
            color: #075985;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-back {
            background: #fff;
            color: #173B4D;
        }

        .action-btn:hover {
            opacity: .85;
        }

        @media(max-width: 600px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="student-profile">

        <div class="profile-header">
            <div>
                <h2>Student Profile</h2>
                <p>Complete student information and account management.</p>
            </div>

            <a href="{{ route('cbt.admin.students.index') }}" class="action-btn btn-back">
                Back to Students
            </a>
        </div>

        <div class="profile-card">
            <h3>Personal Information</h3>

            <div class="profile-grid">
                <div>
                    <span class="detail-label">Full Name</span>
                    <div class="detail-value">
                        {{ trim(implode(' ', array_filter([
    $student->first_name,
    $student->other_names,
    $student->last_name
]))) }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Admission Number</span>
                    <div class="detail-value">{{ $student->admission_number }}</div>
                </div>

                <div>
                    <span class="detail-label">Email Address</span>
                    <div class="detail-value">{{ $student->user?->email ?? 'Not available' }}</div>
                </div>

                <div>
                    <span class="detail-label">Class</span>
                    <div class="detail-value">
                        {{ $student->schoolClass?->name ?? $student->class_name }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Date of Birth</span>
                    <div class="detail-value">
                        {{ $student->date_of_birth?->format('d M, Y') ?? 'Not provided' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Gender</span>
                    <div class="detail-value">{{ $student->gender ?? 'Not provided' }}</div>
                </div>
            </div>
        </div>

        <div class="profile-card">
            <h3>Guardian Information</h3>

            <div class="profile-grid">
                <div>
                    <span class="detail-label">Guardian Name</span>
                    <div class="detail-value">{{ $student->guardian_name ?? 'Not provided' }}</div>
                </div>

                <div>
                    <span class="detail-label">Guardian Phone</span>
                    <div class="detail-value">{{ $student->guardian_phone ?? 'Not provided' }}</div>
                </div>
            </div>
        </div>

        <div class="profile-card">
            <h3>Account Information</h3>

            <div class="profile-grid">
                <div>
                    <span class="detail-label">Account Status</span>

                    @if($student->is_active)
                        <span class="status status-active">Active</span>
                    @else
                        <span class="status status-inactive">Inactive</span>
                    @endif
                </div>

                <div>
                    <span class="detail-label">Registered On</span>
                    <div class="detail-value">
                        {{ $student->created_at?->format('d M, Y') ?? 'Not available' }}
                    </div>
                </div>
            </div>

            <div class="profile-actions">

                <a href="{{ route('cbt.admin.students.edit', $student) }}" class="action-btn btn-edit">
                    Edit Student
                </a>

                <form method="POST" action="{{ route('cbt.admin.students.toggle-status', $student) }}">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="action-btn btn-status">
                        {{ $student->is_active ? 'Deactivate Account' : 'Activate Account' }}
                    </button>
                </form>

                <form method="POST" action="{{ route('cbt.admin.students.destroy', $student) }}"
                    onsubmit="return confirm('Are you sure you want to permanently delete this student and their login account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="action-btn btn-delete">
                        Delete Student
                    </button>
                </form>

            </div>
        </div>

    </div>

</body>

</html>