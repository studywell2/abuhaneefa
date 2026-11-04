<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result PIN Details | Abuhaneefa Islamic Academy</title>

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

        .content-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
        }

        .section-heading {
            color: var(--navy);
            font-weight: 700;
            border-bottom: 1px solid #e5e9eb;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .detail-label {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 18px;
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

        .table thead th {
            background: #eaf0f2;
            color: var(--navy);
            white-space: nowrap;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <div class="page-header mb-4">
        <h3 class="fw-bold mb-2">Abuhaneefa Islamic Academy</h3>
        <p class="mb-1">CBT Management System</p>
        <h5 class="mt-3 mb-0">Result PIN Details</h5>
        <small>View PIN information, payment records and revocation history.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">PIN Record #{{ $resultPin->id }}</h4>
            <p class="text-muted mb-0">Administrator PIN management record.</p>
        </div>

        <a href="{{ route('cbt.admin.result-pins.index') }}"
           class="btn btn-outline-secondary">
            Back to PIN Management
        </a>
    </div>

    @php
        $student = $resultPin->student;

        $studentName = $student
            ? trim(
                $student->first_name . ' ' .
                ($student->other_names ?? '') . ' ' .
                $student->last_name
            )
            : 'Student unavailable';

        $statusClass = match($resultPin->status) {
            'active' => 'status-active',
            'revoked' => 'status-revoked',
            default => 'status-expired',
        };
    @endphp

    <div class="card content-card mb-4">
        <div class="card-body p-4">

            <h5 class="section-heading">1. Student Information</h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="detail-label">Student Name</div>
                    <div class="detail-value">{{ $studentName }}</div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Admission Number</div>
                    <div class="detail-value">
                        {{ $student?->admission_number ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Class</div>
                    <div class="detail-value">
                        {{ $student?->schoolClass?->name ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <h5 class="section-heading mt-3">2. Result PIN Information</h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="detail-label">PIN Record ID</div>
                    <div class="detail-value">#{{ $resultPin->id }}</div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">PIN Status</div>
                    <div class="detail-value">
                        <span class="badge {{ $statusClass }}">
                            {{ ucfirst($resultPin->status) }}
                        </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Issued By</div>
                    <div class="detail-value">
                        {{ $resultPin->issuer?->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Date Issued</div>
                    <div class="detail-value">
                        {{ $resultPin->issued_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Starting Period</div>
                    <div class="detail-value">
                        {{ $resultPin->start_term }},
                        {{ $resultPin->start_academic_year }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Ending Period</div>
                    <div class="detail-value">
                        {{ $resultPin->end_term }},
                        {{ $resultPin->end_academic_year }}
                    </div>
                </div>
            </div>

            <div class="alert alert-info mb-0">
                The original PIN is not stored in readable form.
                For security reasons, it cannot be retrieved from this page.
            </div>

        </div>
    </div>

    <div class="card content-card mb-4">
        <div class="card-body p-4">

            <h5 class="section-heading">3. Payment History</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Reference</th>
                            <th>Payment Date</th>
                            <th>Recorded By</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($resultPin->payments as $payment)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $payment->currency }}
                                        {{ number_format((float) $payment->amount_paid, 2) }}
                                    </strong>
                                </td>

                                <td>{{ $payment->payment_method }}</td>

                                <td>{{ $payment->payment_reference }}</td>

                                <td>
                                    {{ $payment->paid_at?->format('d M Y') ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $payment->recorder?->name ?? 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No payment records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <strong>Total Payment:</strong>

                <span class="text-success fw-bold">
                    ₦{{ number_format(
                        (float) $resultPin->payments->sum('amount_paid'),
                        2
                    ) }}
                </span>
            </div>

        </div>
    </div>

    @if($resultPin->status === 'revoked')
        <div class="card content-card mb-4">
            <div class="card-body p-4">

                <h5 class="section-heading">4. Revocation History</h5>

                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-label">Revoked By</div>
                        <div class="detail-value">
                            {{ $resultPin->revoker?->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="detail-label">Date Revoked</div>
                        <div class="detail-value">
                            {{ $resultPin->revoked_at?->format('d M Y, h:i A') ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="detail-label">Reason</div>
                        <div class="detail-value">
                            {{ $resultPin->revocation_reason ?? 'No reason recorded.' }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    @if($resultPin->status === 'active')
        <div class="card content-card">
            <div class="card-body p-4">

                <h5 class="section-heading text-danger">
                    5. Revoke Result PIN
                </h5>

                <div class="alert alert-warning">
                    Revoking this PIN will immediately prevent it from
                    being used for result access once PIN validation is
                    connected. This action cannot be undone.
                </div>

                <form method="POST"
                      action="{{ route('cbt.admin.result-pins.revoke', $resultPin) }}">

                    @csrf

                    <div class="mb-3">
                        <label for="revocation_reason" class="form-label fw-bold">
                            Reason for Revocation
                        </label>

                        <textarea name="revocation_reason"
                                  id="revocation_reason"
                                  class="form-control"
                                  rows="3"
                                  minlength="5"
                                  maxlength="500"
                                  required
                                  placeholder="Enter the reason for revoking this PIN">{{ old('revocation_reason') }}</textarea>

                        @error('revocation_reason')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to revoke this Result PIN? This action cannot be undone.')">
                        Revoke PIN
                    </button>

                </form>

            </div>
        </div>
    @endif

    <div class="text-center text-muted small mt-4">
        &copy; {{ date('Y') }} Abuhaneefa Islamic Academy.
        All rights reserved.
    </div>

</div>

</body>
</html>