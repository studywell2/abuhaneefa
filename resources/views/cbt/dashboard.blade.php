
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
            <span class="role">{{ auth()->user()->role }}</span>

            <h1 style="margin: 20px 0 10px; font-size: 28px;">
                Welcome, {{ auth()->user()->name }}!
            </h1>

            <p style="color: #647783; line-height: 1.7;">
                You have successfully signed in to the academy's CBT portal.
            </p>

            <div class="notice">
                <strong>CBT portal setup in progress</strong>
                <p style="margin-bottom: 0;">
                    Examination management, student records, exam sessions,
                    result approval and result PIN features will be added
                    in stages.
                </p>
            </div>
        </section>
    </main>
</body>
</html>
