
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $examination->title }} | Abu Haneefah CBT</title>

    <style>
        :root {
            --navy: #173B4D;
            --blue: #315C72;
            --background: #F3F7F8;
            --gold: #D6A84F;
            --white: #ffffff;
            --muted: #64748b;
            --border: #e2e8f0;
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

        .topbar {
            background: var(--navy);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .brand h2 {
            margin: 0 0 5px;
            font-size: 18px;
        }

        .brand p {
            margin: 0;
            font-size: 12px;
            color: #dbe7ec;
        }

        .timer {
            background: white;
            color: var(--navy);
            padding: 12px 18px;
            border-radius: 8px;
            text-align: center;
            min-width: 135px;
            border-bottom: 3px solid var(--gold);
        }

        .timer-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .timer-value {
            font-size: 23px;
            font-weight: bold;
            font-variant-numeric: tabular-nums;
        }

        .timer.expired {
            background: #fee2e2;
            color: #991b1b;
            border-bottom-color: #dc2626;
        }

        .container {
            max-width: 1250px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .exam-heading {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .exam-heading h1 {
            color: var(--navy);
            font-size: 22px;
            margin: 0 0 8px;
        }

        .exam-heading p {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .exam-details {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-top: 17px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .detail {
            font-size: 12px;
            color: var(--muted);
        }

        .detail strong {
            display: block;
            color: var(--navy);
            font-size: 14px;
            margin-top: 5px;
        }

        .exam-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            gap: 20px;
            align-items: start;
        }

        .question-panel,
        .navigation-panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 24px;
        }

        .question-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-bottom: 17px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 22px;
        }

        .question-number {
            color: var(--navy);
            font-size: 15px;
            font-weight: bold;
        }

        .question-mark {
            background: #fff5dd;
            color: #805b12;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .question-text {
            font-size: 17px;
            line-height: 1.8;
            color: #243746;
            margin-bottom: 25px;
            white-space: pre-wrap;
        }

        .options {
            display: grid;
            gap: 12px;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
            font-size: 14px;
            line-height: 1.5;
        }

        .option:hover {
            border-color: var(--blue);
            background: #f5f9fa;
        }

        .option.selected {
            border-color: var(--blue);
            background: #eaf1f4;
        }

        .option input {
            accent-color: var(--navy);
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .option input:disabled {
            cursor: not-allowed;
        }

        .question-actions {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .action-button {
            padding: 11px 17px;
            border: 0;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .previous-button {
            background: #eaf1f4;
            color: var(--navy);
        }

        .next-button {
            background: var(--navy);
            color: white;
        }

        .action-button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .submit-button {
    width: 100%;
    margin-top: 20px;
    padding: 14px;
    background: var(--gold);
    color: var(--navy);
    border: none;
    border-radius: 7px;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
}

.submit-button:hover {
    background: #c99b3e;
}

.submit-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

        .navigation-panel h3 {
            color: var(--navy);
            margin: 0 0 8px;
            font-size: 16px;
        }

        .navigation-panel > p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 0 0 18px;
        }

        .question-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 9px;
        }

        .question-nav {
            height: 38px;
            border: 1px solid var(--border);
            background: white;
            color: var(--navy);
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .question-nav.current {
            background: var(--navy);
            color: white;
            border-color: var(--navy);
        }

        .question-nav.answered {
            background: #e5f2e9;
            border-color: #6aa77a;
            color: #24643a;
        }

        .question-nav.current.answered {
            background: var(--navy);
            color: white;
            border-color: var(--navy);
        }

        .legend {
            display: grid;
            gap: 10px;
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid var(--border);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 11px;
            color: var(--muted);
        }

        .legend-box {
            width: 13px;
            height: 13px;
            border-radius: 3px;
            border: 1px solid var(--border);
        }

        .legend-current {
            background: var(--navy);
        }

        .legend-answered {
            background: #e5f2e9;
            border-color: #6aa77a;
        }

        .legend-unanswered {
            background: white;
        }

        .information {
            background: #fffaf0;
            border: 1px solid #f0dfb6;
            border-left: 4px solid var(--gold);
            padding: 15px;
            border-radius: 7px;
            margin-top: 22px;
        }

        .information p {
            margin: 0;
            color: #75551b;
            font-size: 12px;
            line-height: 1.7;
        }

        .save-status {
            font-size: 12px;
            margin-top: 15px;
            color: var(--muted);
        }

        .empty-questions {
            background: white;
            padding: 35px;
            text-align: center;
            border-radius: 10px;
        }

        .empty-questions h2 {
            color: var(--navy);
        }

        .empty-questions p {
            color: var(--muted);
        }

        footer {
            text-align: center;
            padding: 25px;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 800px) {
            .exam-layout {
                grid-template-columns: 1fr;
            }

            .navigation-panel {
                order: -1;
            }

            .question-grid {
                grid-template-columns: repeat(8, 1fr);
            }
        }

        @media (max-width: 500px) {
            .topbar {
                padding: 15px;
            }

            .brand h2 {
                font-size: 15px;
            }

            .timer {
                min-width: 105px;
                padding: 10px;
            }

            .timer-value {
                font-size: 19px;
            }

            .container {
                padding: 0 12px;
                margin: 18px auto;
            }

            .question-panel,
            .navigation-panel {
                padding: 17px;
            }

            .question-grid {
                grid-template-columns: repeat(5, 1fr);
            }

            .question-actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">
        <h2>Abu Haneefah Islamic Academy</h2>
        <p>Computer-Based Testing Portal</p>
    </div>

    <div class="timer" id="timerBox">
        <span class="timer-label">Time Remaining</span>
        <span class="timer-value" id="timer">--:--</span>
    </div>
</header>

<main class="container">

    <section class="exam-heading">
        <h1>{{ $examination->title }}</h1>

        <p>
            {{ $examination->subject }}
            &middot;
            {{ $examination->schoolClass->name ?? 'N/A' }}
            &middot;
            {{ $examination->academic_year }}
            &middot;
            {{ $examination->term }} Term
        </p>

        <div class="exam-details">
            <div class="detail">
                Duration
                <strong>{{ $examination->duration_minutes }} Minutes</strong>
            </div>

            <div class="detail">
                Total Questions
                <strong>{{ $questions->count() }}</strong>
            </div>

            <div class="detail">
                Total Marks
                <strong>{{ $examination->total_marks }}</strong>
            </div>

            <div class="detail">
                Pass Mark
                <strong>{{ $examination->pass_mark }}</strong>
            </div>
        </div>
    </section>

    @if($questions->isEmpty())

        <section class="empty-questions">
            <h2>No Questions Available</h2>
            <p>Please contact the examination office.</p>
        </section>

    @else

        <div class="exam-layout">

            <section class="question-panel">

                @foreach($questions as $index => $question)

                    <div class="question-container"
                         data-question="{{ $index }}"
                         style="{{ $index === 0 ? '' : 'display:none;' }}">

                        <div class="question-top">

                            <span class="question-number">
                                Question {{ $index + 1 }} of {{ $questions->count() }}
                            </span>

                            <span class="question-mark">
                                {{ $question->marks }} Mark(s)
                            </span>

                        </div>

                        <div class="question-text">
                            {{ $question->question_text }}
                        </div>

                        <div class="options">

                            @foreach(['A', 'B', 'C', 'D'] as $option)

                                <label class="option
                                    {{ ($savedAnswers[$question->id] ?? null) === $option ? 'selected' : '' }}"
                                    data-option-label>

                                    <input
                                        type="radio"
                                        name="question_{{ $question->id }}"
                                        value="{{ $option }}"
                                        data-question-id="{{ $question->id }}"
                                        @if(($savedAnswers[$question->id] ?? null) === $option)
                                            checked
                                        @endif
                                    >

                                    <strong>{{ $option }}.</strong>

                                    <span>
                                        {{ $question->{'option_' . strtolower($option)} }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>

                @endforeach

                <p class="save-status" id="saveStatus" aria-live="polite">
                    Your answers are saved automatically.
                </p>

                <div class="question-actions">

                    <button type="button"
                            class="action-button previous-button"
                            id="previousButton">
                        Previous
                    </button>

                    <button type="button"
                            class="action-button next-button"
                            id="nextButton">
                        Next Question
                    </button>

                </div>

            </section>

            <aside class="navigation-panel">

                <h3>Question Navigation</h3>

                <p>
                    Select a question number to move directly to that question.
                </p>

                <div class="question-grid" id="questionGrid">

                    @foreach($questions as $index => $question)

                        <button type="button"
                                class="question-nav
                                {{ $index === 0 ? 'current' : '' }}
                                {{ isset($savedAnswers[$question->id]) ? 'answered' : '' }}"
                                data-nav="{{ $index }}">
                            {{ $index + 1 }}
                        </button>

                    @endforeach

                </div>

                <div class="legend">

                    <div class="legend-item">
                        <span class="legend-box legend-current"></span>
                        Current question
                    </div>

                    <div class="legend-item">
                        <span class="legend-box legend-answered"></span>
                        Answer selected
                    </div>

                    <div class="legend-item">
                        <span class="legend-box legend-unanswered"></span>
                        Not answered
                    </div>

                </div>

                <div class="information">
                    <p>
                        Read each question carefully. Your answers are saved
                        automatically. Do not close the examination until
                        you have submitted it.
                    </p>
                </div>

                <button type="button" class="submit-button" id="submitButton">
                    Submit Examination
                </button>

            </aside>

        </div>

    @endif

</main>

<footer>
    Abu Haneefah Islamic Academy · Computer-Based Testing Portal
</footer>

<script>
    let currentQuestion = 0;
    let timerInterval = null;
    let remainingSeconds = Number(@json($remainingSeconds));

    const questionContainers = document.querySelectorAll('.question-container');
    const navigationButtons = document.querySelectorAll('.question-nav');

    const previousButton = document.getElementById('previousButton');
    const nextButton = document.getElementById('nextButton');

    const timerElement = document.getElementById('timer');
    const timerBox = document.getElementById('timerBox');
    const saveStatus = document.getElementById('saveStatus');

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    const saveAnswerUrl = @json(route(
    'cbt.student.examinations.answer',
    $examination
));

    const examinationListUrl = @json(route(
    'cbt.student.examinations.index'
));

    const submitUrl = @json(route(
    'cbt.student.examinations.submit',
    $examination
));

    let pendingSaves = new Set();
        let submissionInProgress = false;
        let saveFailed = false;

        const submitButton = document.getElementById('submitButton');

    function showQuestion(index) {
        if (!questionContainers.length) {
            return;
        }

        if (index < 0 || index >= questionContainers.length) {
            return;
        }

        currentQuestion = index;

        questionContainers.forEach((question, position) => {
            question.style.display =
                position === index ? 'block' : 'none';
        });

        navigationButtons.forEach((button, position) => {
            button.classList.toggle('current', position === index);
        });

        previousButton.disabled = index === 0;

        nextButton.disabled =
            index === questionContainers.length - 1;

        nextButton.textContent =
            index === questionContainers.length - 1
                ? 'Last Question'
                : 'Next Question';
    }

    function updateAnsweredStatus() {
        questionContainers.forEach((question, index) => {

            const selected = question.querySelector(
                'input[type="radio"]:checked'
            );

            if (navigationButtons[index]) {
                navigationButtons[index].classList.toggle(
                    'answered',
                    !!selected
                );
            }
        });
    }

    previousButton?.addEventListener('click', () => {
        showQuestion(currentQuestion - 1);
    });

    nextButton?.addEventListener('click', () => {
        showQuestion(currentQuestion + 1);
    });

    navigationButtons.forEach((button) => {

        button.addEventListener('click', () => {
            showQuestion(Number(button.dataset.nav));
        });

    });

    // Save selected answers automatically.
    // Save selected answers automatically.

    document.querySelectorAll('.option input').forEach((input) => {

        input.addEventListener('change', async function () {

            if (submissionInProgress) {
                return;
            }

            const selectedInput = this;
            const question = selectedInput.closest('.question-container');
            const questionId = selectedInput.dataset.questionId;

            question.querySelectorAll('.option').forEach((option) => {
                option.classList.remove('selected');
            });

            selectedInput.closest('.option').classList.add('selected');

            updateAnsweredStatus();

            const saveTask = (async () => {

                saveStatus.textContent = 'Saving answer...';
                saveStatus.style.color = '#64748b';

                try {

                    const response = await fetch(saveAnswerUrl, {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },

                        body: JSON.stringify({
                            question_id: questionId,
                            selected_option: selectedInput.value
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(
                            data.message || 'Unable to save answer.'
                        );
                    }

                    saveStatus.textContent = 'Answer saved successfully.';
                    saveStatus.style.color = '#24643a';

                } catch (error) {

                    saveFailed = true;

                    saveStatus.textContent =
                        'Answer not saved. Check your connection and try again.';

                    saveStatus.style.color = '#b42318';

                    console.error(error);
                }

            })();

            pendingSaves.add(saveTask);

            await saveTask;

            pendingSaves.delete(saveTask);

        });

    });

    // Submit examination.

        async function submitExamination(automatic = false) {

            if (submissionInProgress) {
                return;
            }

            if (!automatic) {
                const confirmed = confirm(
                    'Are you sure you want to submit your examination? You will not be able to change your answers afterwards.'
                );

                if (!confirmed) {
                    return;
                }
            }

            submissionInProgress = true;

            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Submitting Examination...';
            }

            if (nextButton) nextButton.disabled = true;
            if (previousButton) previousButton.disabled = true;

            document.querySelectorAll('.option input').forEach((input) => {
                input.disabled = true;
            });

            if (timerInterval) {
                clearInterval(timerInterval);
            }

            saveStatus.textContent = 'Preparing your examination for submission...';

            try {

                await Promise.all([...pendingSaves]);

                if (saveFailed && !automatic) {

                    const retry = confirm(
                        'Some answers could not be saved. Do you want to submit the answers that were successfully saved?'
                    );

                    if (!retry) {
                        submissionInProgress = false;

                        document.querySelectorAll('.option input').forEach((input) => {
                            input.disabled = false;
                        });

                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = 'Submit Examination';
                        }

                        showQuestion(currentQuestion);

                        return;
                    }
                }

                const response = await fetch(submitUrl, {
                    method: 'POST',

                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Unable to submit examination.'
                    );
                }

                saveStatus.textContent = data.message;
                saveStatus.style.color = '#24643a';

                alert(data.message);

                window.location.href = examinationListUrl;

            } catch (error) {

                console.error(error);

                alert(
                    error.message ||
                    'Submission failed. Please check your internet connection.'
                );

                submissionInProgress = false;

                document.querySelectorAll('.option input').forEach((input) => {
                    input.disabled = false;
                });

                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit Examination';
                }

                showQuestion(currentQuestion);
            }
        }

        submitButton?.addEventListener('click', () => {
            submitExamination(false);
        });
    // Countdown timer.
    // Countdown timer.

    function updateTimer() {

        const minutes = Math.floor(remainingSeconds / 60);
        const seconds = remainingSeconds % 60;

        timerElement.textContent =
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');

        if (remainingSeconds <= 300) {
            timerBox.classList.add('expired');
        }

        if (remainingSeconds <= 0) {

            remainingSeconds = 0;

            timerElement.textContent = '00:00';

            clearInterval(timerInterval);

            submitExamination(true);

            return;
        }

        remainingSeconds--;
    }

    // Initialize the page.

    showQuestion(0);
    updateAnsweredStatus();
    updateTimer();

    if (remainingSeconds > 0) {
        timerInterval = setInterval(updateTimer, 1000);
    }

</script>

</body>
</html>
