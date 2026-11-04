<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result PIN Management | Abuhaneefa Islamic Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --gold: #D6A84F;
            --light: #F3F7F8;
        }

        body {
            background: var(--light);
            color: #263238;
            font-family: Arial, sans-serif;
        }

        .page-header {
            background: var(--navy);
            color: white;
            padding: 28px;
            border-radius: 12px;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--navy);
            border: none;
            font-weight: 600;
        }

        .btn-gold:hover {
            background: #c79a3e;
            color: var(--navy);
        }

        .content-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
        }

        .table thead th {
            background: #eaf0f2;
            color: var(--navy);
            white-space: nowrap;
        }

        .status-active {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-revoked {
            background: #f8d7da;
            color: #842029;
        }

        .status-expired {
            background: #e2e3e5;
            color: #41464b;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <div class="page-header mb-4">
        <h3 class="fw-bold mb-2">Abuhaneefa Islamic Academy</h3>
        <p class="mb-1">CBT Management System</p>
        <h5 class="mt-3 mb-0">Result PIN Management</h5>
        <small>Manage student result access PINs and payment records.</small>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('issued_pin'))
    <div class="alert alert-warning border border-warning p-4">
        <h5 class="fw-bold">New Result PIN Issued</h5>

        <p class="mb-2">
            Student: <strong>{{ session('issued_student') }}</strong>
        </p>

        <p class="mb-2">Generated Result PIN:</p>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <h3 class="fw-bold mb-0 text-dark">
                {{ session('issued_pin') }}
            </h3>

            <button type="button"
                    class="btn btn-sm btn-dark"
                    onclick="navigator.clipboard.writeText('{{ session('issued_pin') }}').then(() => alert('PIN copied successfully.'))">
                Copy PIN
            </button>
        </div>

        <hr>

        <strong>Important:</strong>
        Copy this PIN and provide it securely to the student.
        It will not be displayed again.
    </div>
@endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Issued Result PINs</h4>
            <p class="text-muted mb-0">View and manage student result access.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('cbt.admin.dashboard') }}" class="btn btn-outline-secondary">
                Back to Dashboard
            </a>

            <a href="{{ route('cbt.admin.result-pins.create') }}" class="btn btn-gold">
                + Issue New PIN
            </a>
        </div>
    </div>

    <div class="card content-card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Admission Number</th>
                            <th>Validity Period</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Issued By</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($resultPins as $pin)
                            @php
                                $student = $pin->student;
                                $studentName = $student
                                    ? trim($student->first_name . ' ' . ($student->other_names ?? '') . ' ' . $student->last_name)
                                    : 'Student unavailable';

                                $paymentTotal = $pin->payments->sum('amount_paid');
                                $statusClass = match($pin->status) {
                                    'active' => 'status-active',
                                    'revoked' => 'status-revoked',
                                    default => 'status-expired',
                                };
                            @endphp

                            <tr>
                                <td>{{ $resultPins->firstItem() + $loop->index }}</td>

                                <td>
                                    <strong>{{ $studentName }}</strong>
                                    <div class="small text-muted">
                                        {{ $student?->schoolClass?->name ?? 'No class' }}
                                    </div>
                                </td>

                                <td>{{ $student?->admission_number ?? 'N/A' }}</td>

                                <td>
                                    <strong>{{ $pin->start_term }}</strong>
                                    <div class="small text-muted">
                                        {{ $pin->start_academic_year }}
                                    </div>
                                    <div class="small">
                                        to {{ $pin->end_term }},
                                        {{ $pin->end_academic_year }}
                                    </div>
                                </td>

                                <td>
                                    ₦{{ number_format((float) $paymentTotal, 2) }}
                                    <div class="small text-muted">
                                        {{ $pin->payments->count() }} payment(s)
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($pin->status) }}
                                    </span>
                                </td>

                                <td>{{ $pin->issuer?->name ?? 'N/A' }}</td>

                                <td>
                                    <a href="{{ route('cbt.admin.result-pins.show', $pin) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <h6 class="fw-bold">No Result PINs Found</h6>
                                    <p class="text-muted mb-0">
                                        No result PIN has been issued yet.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $resultPins->links() }}
            </div>

        </div>
    </div>

    <div class="text-center text-muted small mt-4">
        &copy; {{ date('Y') }} Abuhaneefa Islamic Academy.
        All rights reserved.
    </div>

</div>

</body>
</html>