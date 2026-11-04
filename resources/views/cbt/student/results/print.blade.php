
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Examination Result Slip | Abu Haneefah Islamic Academy</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 14mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #edf2f5;
            font-family: Arial, Helvetica, sans-serif;
            color: #243746;
            font-size: 13px;
        }

        .print-actions {
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .print-button {
            background: #173B4D;
            color: white;
            border: 0;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-button {
            background: white;
            color: #173B4D;
            border: 1px solid #cbd5e1;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .sheet {
            width: 210mm;
            min-height: 270mm;
            margin: 0 auto 30px;
            padding: 12mm;
            background: white;
            border: 1px solid #dbe3e8;
        }

        .school-header {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 18px;
            border-bottom: 3px solid #173B4D;
        }

        .school-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        .school-name {
            flex: 1;
            text-align: center;
        }

        .school-name h1 {
            color: #173B4D;
            font-size: 22px;
            margin: 0 0 7px;
            text-transform: uppercase;
        }

        .school-name p {
            margin: 3px 0;
            color: #64748b;
            font-size: 12px;
        }

        .document-title {
            text-align: center;
            margin: 23px 0;
        }

        .document-title h2 {
            color: #173B4D;
            font-size: 18px;
            margin: 0 0 6px;
            text-transform: uppercase;
        }

        .document-title p {
            color: #64748b;
            font-size: 11px;
            margin: 0;
        }

        .section-title {
            background: #173B4D;
            color: white;
            padding: 9px 12px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 20px 0 0;
        }

        .details-table,
        .scores-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table td {
            border: 1px solid #dbe3e8;
            padding: 10px;
            width: 50%;
        }

        .detail-label {
            display: block;
            color: #64748b;
            font-size: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .detail-value {
            color: #173B4D;
            font-weight: bold;
            font-size: 12px;
        }

        .scores-table th {
            background: #eaf1f4;
            color: #173B4D;
            padding: 12px 9px;
            border: 1px solid #dbe3e8;
            text-align: left;
        }

        .scores-table td {
            padding: 12px 9px;
            border: 1px solid #dbe3e8;
        }

        .scores-table th:not(:first-child),
        .scores-table td:not(:first-child) {
            text-align: center;
        }

        .total-row {
            background: #f3f7f8;
            font-weight: bold;
            color: #173B4D;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .summary-box {
            border: 1px solid #dbe3e8;
            padding: 14px;
            text-align: center;
        }

        .summary-box span {
            display: block;
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .summary-box strong {
            color: #173B4D;
            font-size: 20px;
        }

        .outcome {
            display: inline-block;
            padding: 7px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }

        .passed {
            background: #dcfce7;
            color: #166534;
        }

        .failed {
            background: #fee2e2;
            color: #991b1b;
        }

        .approval-section {
            margin-top: 25px;
            border: 1px solid #dbe3e8;
            padding: 15px;
        }

        .approval-section h3 {
            margin: 0 0 12px;
            color: #173B4D;
            font-size: 13px;
        }

        .approval-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .approval-grid p {
            margin: 5px 0;
            font-size: 11px;
            line-height: 1.6;
        }

        .approval-label {
            color: #64748b;
        }

        .approval-value {
            color: #173B4D;
            font-weight: bold;
        }

        .official-note {
            margin-top: 22px;
            padding: 12px;
            background: #f3f7f8;
            border-left: 4px solid #d6a84f;
            font-size: 10px;
            line-height: 1.6;
            color: #475569;
        }

        .signature-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 45px;
        }

        .signature-line {
            border-top: 1px solid #64748b;
            padding-top: 8px;
            text-align: center;
            font-size: 10px;
            color: #64748b;
        }

        .footer {
            margin-top: 30px;
            padding-top: 12px;
            border-top: 1px solid #dbe3e8;
            text-align: center;
            color: #64748b;
            font-size: 10px;
        }

        @media print {
            body {
                background: white;
            }

            .print-actions {
                display: none !important;
            }

            .sheet {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 0;
                border: none;
            }

            .section-title,
            .scores-table th,
            .total-row,
            .official-note,
            .outcome {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        @media screen and (max-width: 800px) {
            .sheet {
                width: 100%;
                min-height: auto;
                padding: 20px;
            }

            .school-header {
                flex-direction: column;
                text-align: center;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $attempt = $result->attempt;
    $examination = $attempt->examination;

    $studentName = trim(implode(' ', array_filter([
        $student->first_name,
        $student->other_names,
        $student->last_name,
    ])));

    $className = $examination->schoolClass->name
        ?? $student->class_name
        ?? 'Not specified';

    $department = strtoupper($className) === 'JSS1'
        || strtoupper($className) === 'JSS2'
        || strtoupper($className) === 'JSS3'
        ? 'Not applicable'
        : ($examination->department ?? 'General');

    $outcome = strtolower($result->outcome);
@endphp

<div class="print-actions">
    <a href="{{ route('cbt.student.results.index') }}" class="back-button">
        Back to Results
    </a>

    <button onclick="window.print()" class="print-button">
        Print Result Slip
    </button>
</div>

<main class="sheet">

    <header class="school-header">

        <img
            src="{{ asset('images/logo.jpg') }}"
            alt="Academy Logo"
            class="school-logo"
        >

        <div class="school-name">
            <h1>Abu Haneefah Islamic Academy</h1>
            <p>Computer-Based Testing Centre</p>
            <p>Knowledge, Discipline and Academic Excellence</p>
        </div>

    </header>


    <section class="document-title">
        <h2>Official Examination Result Slip</h2>
        <p>Individual Student Academic Performance Record</p>
    </section>


    <div class="section-title">Student Information</div>

    <table class="details-table">
        <tr>
            <td>
                <span class="detail-label">Student Name</span>
                <span class="detail-value">{{ $studentName }}</span>
            </td>

            <td>
                <span class="detail-label">Admission Number</span>
                <span class="detail-value">
                    {{ $student->admission_number }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="detail-label">Class</span>
                <span class="detail-value">{{ $className }}</span>
            </td>

            <td>
                <span class="detail-label">Department</span>
                <span class="detail-value">{{ $department }}</span>
            </td>
        </tr>
    </table>


    <div class="section-title">Examination Information</div>

    <table class="details-table">
        <tr>
            <td>
                <span class="detail-label">Examination</span>
                <span class="detail-value">{{ $examination->title }}</span>
            </td>

            <td>
                <span class="detail-label">Subject</span>
                <span class="detail-value">{{ $examination->subject }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="detail-label">Academic Year</span>
                <span class="detail-value">{{ $examination->academic_year }}</span>
            </td>

            <td>
                <span class="detail-label">Term</span>
                <span class="detail-value">{{ $examination->term }} Term</span>
            </td>
        </tr>
    </table>


    <div class="section-title">Academic Performance</div>

    <table class="scores-table">
        <thead>
            <tr>
                <th>Assessment Component</th>
                <th>Score Obtained</th>
                <th>Maximum Score</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Continuous Assessment (CA)</td>
                <td>{{ $result->ca_marks ?? 0 }}</td>
                <td>{{ $examination->ca_total }}</td>
            </tr>

            <tr>
                <td>Objective</td>
                <td>{{ $result->objective_marks ?? 0 }}</td>
                <td>{{ $examination->objective_total }}</td>
            </tr>

            <tr>
                <td>Theory</td>
                <td>{{ $result->theory_marks ?? 0 }}</td>
                <td>{{ $examination->theory_total }}</td>
            </tr>

            <tr class="total-row">
                <td>Total Score</td>
                <td>{{ $result->marks_obtained }}</td>
                <td>{{ $result->total_marks }}</td>
            </tr>
        </tbody>
    </table>


    <div class="summary">

        <div class="summary-box">
            <span>Final Score</span>
            <strong>
                {{ $result->marks_obtained }}/{{ $result->total_marks }}
            </strong>
        </div>

        <div class="summary-box">
            <span>Percentage</span>
            <strong>
                {{ number_format((float) $result->percentage, 2) }}%
            </strong>
        </div>

        <div class="summary-box">
            <span>Examination Outcome</span>

            <strong>
                <span class="outcome {{ $outcome === 'passed' ? 'passed' : 'failed' }}">
                    {{ ucfirst($result->outcome) }}
                </span>
            </strong>
        </div>

    </div>


    <section class="approval-section">

        <h3>Examination Review and Approval</h3>

        <div class="approval-grid">

            <div>
                <p>
                    <span class="approval-label">Examiner:</span><br>
                    <span class="approval-value">
                        {{ $result->examiner?->name ?? 'Not recorded' }}
                    </span>
                </p>

                <p>
                    <span class="approval-label">Review Date:</span><br>
                    <span class="approval-value">
                        {{ $result->reviewed_at
                            ? $result->reviewed_at->format('d M Y')
                            : 'Not recorded' }}
                    </span>
                </p>
            </div>

            <div>
                <p>
                    <span class="approval-label">Approved By:</span><br>
                    <span class="approval-value">
                        {{ $result->approver?->name ?? 'School Administrator' }}
                    </span>
                </p>

                <p>
                    <span class="approval-label">Approval Date:</span><br>
                    <span class="approval-value">
                        {{ $result->approved_at
                            ? $result->approved_at->format('d M Y')
                            : 'Not recorded' }}
                    </span>
                </p>
            </div>

        </div>

        <p style="margin-top: 12px; font-size: 11px; color: #166534;">
            Result Status: Approved
        </p>

    </section>


    <div class="official-note">
        This result slip contains the approved examination record
        maintained by Abu Haneefah Islamic Academy. It is intended
        for the student's academic records and verification by the
        academy.
    </div>


    <div class="signature-area">
        <div class="signature-line">
            Examiner's Signature
        </div>

        <div class="signature-line">
            School Administrator's Signature
        </div>
    </div>


    <footer class="footer">
        Abu Haneefah Islamic Academy · Computer-Based Testing Portal
        <br>
        Generated on {{ now()->format('d M Y, h:i A') }}
    </footer>

</main>

</body>
</html>
