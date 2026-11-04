<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Result PIN | Abuhaneefa Islamic Academy</title>

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
            font-family: Arial, sans-serif;
            color: #263238;
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

        .form-label {
            font-weight: 600;
            color: var(--navy);
        }

        .section-heading {
            color: var(--navy);
            font-weight: 700;
            border-bottom: 1px solid #e5e9eb;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .info-box {
            background: #eaf2f5;
            border-left: 4px solid var(--blue);
            padding: 15px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <div class="page-header mb-4">
        <h3 class="fw-bold mb-2">Abuhaneefa Islamic Academy</h3>
        <p class="mb-1">CBT Management System</p>
        <h5 class="mt-3 mb-0">Issue Student Result PIN</h5>
        <small>Record payment and generate a result access PIN.</small>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">New Result PIN</h4>
            <p class="text-muted mb-0">
                Complete the information below to issue a PIN.
            </p>
        </div>

        <a href="{{ route('cbt.admin.result-pins.index') }}"
           class="btn btn-outline-secondary">
            Back to PIN Management
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card content-card">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('cbt.admin.result-pins.store') }}">
                @csrf

                <h5 class="section-heading">1. Student Information</h5>

                <div class="mb-4">
                    <label for="student_id" class="form-label">
                        Select Student <span class="text-danger">*</span>
                    </label>

                    <select name="student_id"
                            id="student_id"
                            class="form-select"
                            required>

                        <option value="">Choose a student</option>

                        @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->first_name }}
                                {{ $student->other_names }}
                                {{ $student->last_name }}

                                - {{ $student->admission_number }}
                                ({{ $student->schoolClass?->name ?? 'No class' }})

                            </option>
                        @endforeach

                    </select>

                    @if($students->isEmpty())
                        <small class="text-danger">
                            No active students are currently available.
                        </small>
                    @endif
                </div>

                <div class="info-box mb-4">
                    <strong>Important:</strong>
                    A result PIN belongs to one student only.
                    It cannot be used to access another student's results.
                </div>

                <h5 class="section-heading">2. Payment Information</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="amount_paid" class="form-label">
                            Amount Paid (₦) <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="amount_paid"
                               id="amount_paid"
                               class="form-control"
                               value="{{ old('amount_paid') }}"
                               min="0.01"
                               step="0.01"
                               placeholder="Enter amount paid"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="payment_method" class="form-label">
                            Payment Method <span class="text-danger">*</span>
                        </label>

                        <select name="payment_method"
                                id="payment_method"
                                class="form-select"
                                required>

                            <option value="">Select payment method</option>

                            <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                            <option value="POS" {{ old('payment_method') == 'POS' ? 'selected' : '' }}>
                                POS
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="payment_reference" class="form-label">
                            Payment Reference <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="payment_reference"
                               id="payment_reference"
                               class="form-control"
                               value="{{ old('payment_reference') }}"
                               maxlength="100"
                               placeholder="Enter receipt or transaction reference"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="paid_at" class="form-label">
                            Payment Date <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                               name="paid_at"
                               id="paid_at"
                               class="form-control"
                               value="{{ old('paid_at', now()->toDateString()) }}"
                               max="{{ now()->toDateString() }}"
                               required>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="notes" class="form-label">
                            Payment Notes (Optional)
                        </label>

                        <textarea name="notes"
                                  id="notes"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Additional payment information">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <h5 class="section-heading">3. Result Access Period</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="start_academic_year" class="form-label">
                            Starting Academic Year <span class="text-danger">*</span>
                        </label>

                        <select name="start_academic_year"
                                id="start_academic_year"
                                class="form-select"
                                required>

                            <option value="">Select academic year</option>

                            @foreach($academicYears as $year)
                                <option value="{{ $year }}"
                                    {{ old('start_academic_year', '2026/2027') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_term" class="form-label">
                            Starting Term <span class="text-danger">*</span>
                        </label>

                        <select name="start_term"
                                id="start_term"
                                class="form-select"
                                required>

                            <option value="">Select starting term</option>

                            @foreach($terms as $term)
                                <option value="{{ $term }}"
                                    {{ old('start_term', 'First') == $term ? 'selected' : '' }}>
                                    {{ $term }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="info-box mb-4">
                    <strong>Two-Term Validity:</strong>
                    The PIN will cover the selected starting term and the
                    immediately following academic term.

                    <br>
                    The system will calculate the ending term automatically.
                </div>

                <div class="alert alert-warning">
                    <strong>Administrator Notice:</strong>
                    Confirm the student's identity, payment amount,
                    payment reference and academic period before issuing.
                    The original PIN will be displayed only once after
                    successful issuance.
                </div>

                <div class="d-flex justify-content-end gap-2 flex-wrap">

                    <a href="{{ route('cbt.admin.result-pins.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-gold"
                            {{ $students->isEmpty() ? 'disabled' : '' }}>
                        Record Payment & Issue PIN
                    </button>

                </div>

            </form>

        </div>
    </div>

    <div class="text-center text-muted small mt-4">
        &copy; {{ date('Y') }} Abuhaneefa Islamic Academy.
        All rights reserved.
    </div>

</div>

</body>
</html>