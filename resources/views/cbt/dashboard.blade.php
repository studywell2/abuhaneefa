<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Dashboard | Abu Haneefah Islamic Academy</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6f8;
            color: #173b4d;
        }

        .topbar {
            background: #173b4d;
            color: white;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(23, 59, 77, 0.07);
        }

        .role {
            display: inline-block;
            background: #fff3d8;
            color: #77551a;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .logout-button {
            border: 1px solid rgba(255, 255, 255, 0.6);
            color: white;
            background: transparent;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .notice {
            margin-top: 24px;
            padding: 18px;
            background: #eef5f8;
            border-left: 4px solid #d6a84f;
            border-radius: 8px;
            line-height: 1.6;
        }

        .dashboard-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
            margin-top: 28px;
        }

        .action-card {
            background: white;
            border: 1px solid #e5ebef;
            border-radius: 12px;
            padding: 22px;
            text-decoration: none;
            color: #173b4d;
            transition: 0.2s ease;
        }

        .action-card:hover {
            border-color: #315c72;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(23, 59, 77, 0.08);
            color: #173b4d;
        }

        .action-card h3 {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 10px;
        }

        .action-card p {
            color: #647783;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .action-label {
            display: inline-block;
            margin-top: 16px;
            color: #315c72;
            font-size: 13px;
            font-weight: bold;
        }

        .action-card.primary {
            border-top: 4px solid #d6a84f;
        }

        @media (max-width: 600px) {
            .container {
                margin: 22px auto;
            }

            .welcome-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

    <header class="topbar">
        <div>
            <strong>Abu Haneefah Islamic Academy</strong>

            <div style="font-size: 13px; margin-top: 5px;">
                Computer-Based Testing Portal
            </div>
        </div>

        <form method="POST" action="{{ route('cbt.logout') }}">
            @csrf

            <button type="submit" class="logout-button">
                Log Out
            </button>
        </form>
    </header>

    <main class="container">

        <section class="welcome-card">

            <span class="role">
                {{ auth()->user()->role }}
            </span>

            <h1 style="margin: 20px 0 10px; font-size: 28px;">
                Welcome, {{ auth()->user()->name }}!
            </h1>

            <p style="color: #647783; line-height: 1.7;">
                You have successfully signed in to the academy's CBT portal.
            </p>

            <div class="notice">
                <strong>CBT Portal</strong>

                <p style="margin-bottom: 0;">
                    The academy's Computer-Based Testing system provides
                    examination management, student records, score entry,
                    result review and administrator approval.
                </p>
            </div>

        </section>

        @if(auth()->user()->role === 'administrator')

            <section class="dashboard-actions">

                <a href="{{ route('cbt.admin.results.index') }}" class="action-card primary">

                    <h3>Result Approval</h3>

                    <p>
                        View examination results submitted by examiners,
                        review student scores and approve or reject results.
                    </p>

                    <span class="action-label">
                        Manage Results →
                    </span>

                </a>

            </section>

        @endif

    </main>

</body>

</html>