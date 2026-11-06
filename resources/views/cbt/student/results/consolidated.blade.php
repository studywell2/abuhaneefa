<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consolidated Result | Abu Haneefah Islamic Academy</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
            color: #243746;
        }

        .page {
            max-width: 950px;
            margin: auto;
            background: #fff;
            padding: 35px;
            border: 1px solid #e2e8f0;
        }

        .school-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #173B4D;
        }

        .school-header img {
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        .school-header h1 {
            color: #173B4D;
            font-size: 23px;
            margin: 0 0 7px;
        }

        .school-header p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .document-title {
            text-align: center;
            margin: 22px 0;
        }

        .document-title h2 {
            color: #173B4D;
            font-size: 19px;
            margin: 0 0 7px;
            text-transform: uppercase;
        }

        .document-title p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
        }

        .student-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px 25px;
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 22px;
        }

        .detail span {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .detail strong {
            color: #173B4D;
            font-size: 13px;
        }

        .period-selector {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .period-selector select {
            padding: 9px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th {
            background: #173B4D;
            color: white;
            padding: 12px 7px;
            text-align: center;
            border: 1px solid #173B4D;
        }

        td {
            padding: 11px 7px;
            text-align: center;
            border: 1px solid #dbe3e8;
        }

        td.subject {
            text-align: left;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .summary-title {
            color: #173B4D;
            font-size: 15px;
            margin: 25px 0 12px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .summary-box {
            padding: 15px 10px;
            background: #eaf1f4;
            border-bottom: 3px solid #D6A84F;
            text-align: center;
        }

        .summary-box span {
            display: block;
            color: #64748b;
            font-size: 10px;
            margin-bottom: 8px;
        }

        .summary-box strong {
            color: #173B4D;
            font-size: 18px;
        }

        .performance-note {
            margin-top: 18px;
            padding: 13px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 12px;
            line-height: 1.7;
        }

        .approval-note {
            margin-top: 20px;
            color: #166534;
            font-size: 11px;
            text-align: center;
        }

        .signatures {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 55px;
        }

        .signature {
            border-top: 1px solid #64748b;
            padding-top: 8px;
            text-align: center;
            font-size: 11px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 10px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 11px 16px;
            border: 0;
            border-radius: 5px;
            background: #173B4D;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 12px;
        }

        .button.secondary {
            background: #64748b;
        }

        .empty {
            padding: 35px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            color: #64748b;
        }

        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .page {
                max-width: none;
                padding: 0;
                border: none;
            }

            .actions,
            .period-selector {
                display: none !important;
            }

            .table-wrap {
                overflow: visible;
            }

            table {
                font-size: 10px;
            }

            tr {
                break-inside: avoid;
            }
        }

        @media (max-width: 650px) {
            body {
                padding: 10px;
            }

            .page {
                padding: 18px;
            }

            .school-header {
                flex-direction: column;
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .student-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $studentName = trim(
        $student->first_name . ' ' .
        ($student->other_names ?? '') . ' ' .
        $student->last_name
    );

    $className = $student->schoolClass->name
        ?? $student->class_name
        ?? 'Not assigned';

    $totalObtained = $results->sum('marks_obtained');
    $totalMaximum = $results->sum('total_marks');

    $overallPercentage = $totalMaximum > 0
        ? ($totalObtained / $totalMaximum) * 100
        : 0;

    $passedCount = $results->filter(function ($result) {
        return strtolower($result->outcome) === 'passed';
    })->count();

    $failedCount = $results->count() - $passedCount;

    $subjectCount = $results->count();
@endphp

<div class="page">

    <div class="actions">
        <a href="{{ route('cbt.student.results.index') }}"
           class="button secondary">
            Back to My Results
        </a>

        <button onclick="window.print()" class="button">
            Print Consolidated Result
        </button>
    </div>

    <header class="school-header">

        <img src="{{ asset('images/logo.jpg') }}" alt="Academy Logo">

        <div>
            <h1>ABU HANEEFAH ISLAMIC ACADEMY</h1>
            <p>COMPUTER-BASED TESTING CENTRE</p>
            <p>Knowledge, Discipline and Excellence</p>
        </div>

    </header>

    <div class="document-title">
        <h2>Consolidated Student Result Sheet</h2>

        <p>
            {{ $selectedTerm }} Term ·
            Academic Year {{ $selectedAcademicYear }}
        </p>
    </div>

    <section class="student-details">

        <div class="detail">
            <span>Student Name</span>
            <strong>{{ $studentName }}</strong>
        </div>

        <div class="detail">
            <span>Admission Number</span>
            <strong>{{ $student->admission_number }}</strong>
        </div>

        <div class="detail">
            <span>Class</span>
            <strong>{{ $className }}</strong>
        </div>

        <div class="detail">
            <span>Department</span>
            <strong>
                {{ $student->department ?? 'Not applicable' }}
            </strong>
        </div>

        <div class="detail">
            <span>Academic Year</span>
            <strong>{{ $selectedAcademicYear }}</strong>
        </div>

        <div class="detail">
            <span>Term</span>
            <strong>{{ $selectedTerm }}</strong>
        </div>

    </section>

    <form method="GET"
          action="{{ route('cbt.student.results.consolidated') }}"
          class="period-selector">

        <label>
            Select academic period:
            <select name="academic_year" required>
                @foreach ($allowedPeriods as $period)
                    <option value="{{ $period['academic_year'] }}"
                        {{ $selectedAcademicYear === $period['academic_year'] ? 'selected' : '' }}>
                        {{ $period['academic_year'] }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Term:
            <select name="term" required>
                @foreach ($allowedPeriods as $period)
                    <option value="{{ $period['term'] }}"
                        {{ $selectedTerm === $period['term'] && $selectedAcademicYear === $period['academic_year'] ? 'selected' : '' }}>
                        {{ $period['term'] }}
                    </option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="button">
            View Result
        </button>

    </form>

    @if ($results->isNotEmpty())

        <div class="table-wrap">

            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Subject</th>
                        <th>CA</th>
                        <th>Objective</th>
                        <th>Theory</th>
                        <th>Total Obtained</th>
                        <th>Maximum</th>
                        <th>Percentage</th>
                        <th>Outcome</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($results as $result)
                        @php
                            $exam = $result->attempt->examination;
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="subject">
                                {{ $exam->subject }}
                            </td>

                            <td>
                                {{ $result->ca_marks ?? 0 }}
                                /{{ $exam->ca_total }}
                            </td>

                            <td>
                                {{ $result->objective_marks ?? 0 }}
                                /{{ $exam->objective_total }}
                            </td>

                            <td>
                                {{ $result->theory_marks ?? 0 }}
                                /{{ $exam->theory_total }}
                            </td>

                            <td>
                                {{ $result->marks_obtained }}
                            </td>

                            <td>
                                {{ $result->total_marks }}
                            </td>

                            <td>
                                {{ number_format((float) $result->percentage, 2) }}%
                            </td>

                            <td>
                                {{ ucfirst($result->outcome) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="5">GRAND TOTAL</th>
                        <th>{{ $totalObtained }}</th>
                        <th>{{ $totalMaximum }}</th>
                        <th>
                            {{ number_format($overallPercentage, 2) }}%
                        </th>
                        <th>—</th>
                    </tr>
                </tfoot>
            </table>

        </div>

        <h3 class="summary-title">Overall Academic Performance</h3>

        <div class="summary-grid">

            <div class="summary-box">
                <span>Subjects Taken</span>
                <strong>{{ $subjectCount }}</strong>
            </div>

            <div class="summary-box">
                <span>Overall Average</span>
                <strong>{{ number_format($overallPercentage, 2) }}%</strong>
            </div>

            <div class="summary-box">
                <span>Subjects Passed</span>
                <strong>{{ $passedCount }}</strong>
            </div>

            <div class="summary-box">
                <span>Subjects Failed</span>
                <strong>{{ $failedCount }}</strong>
            </div>

        </div>

        <div class="performance-note">
            <strong>Performance Summary:</strong>

            The student completed {{ $subjectCount }} approved subject
            examination(s), obtaining {{ $totalObtained }}
            out of {{ $totalMaximum }} available marks.

            The overall percentage is
            {{ number_format($overallPercentage, 2) }}%.
        </div>

        <p class="approval-note">
            All results displayed on this sheet have been approved
            by the school administrator.
        </p>

        <div class="signatures">
            <div class="signature">
                Class Teacher's Signature
            </div>

            <div class="signature">
                School Administrator's Signature
            </div>
        </div>

    @else

        <div class="empty">
            No approved subject results are available for this academic period.
        </div>

    @endif

    <footer class="footer">
        Abu Haneefah Islamic Academy · Computer-Based  Centre
        <br>
        This document contains approved school examination records.
    </footer>

</div>

</body>
</html>