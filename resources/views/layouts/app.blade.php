<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Abu Haneefah Islamic Academy')</title>
    <meta name="description" content="Abu Haneefah Islamic Academy - Providing quality Islamic and contemporary education rooted in Qur'an and Sunnah. Building faith, knowledge, and character for a better Ummah.">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpeg">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-white text-gray-800 antialiased">

    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox-overlay">
        <span id="lightbox-close" class="lightbox-close">&times;</span>
        <img id="lightbox-img" src="" alt="">
    </div>

    @yield('scripts')
</body>
</html>
