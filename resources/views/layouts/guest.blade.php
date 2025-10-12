<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', "Login")</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins">
    <!-- Background -->
    <div class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center"
         style="background-image: url({{ asset('images/background.png') }})">

        <!-- Overlay -->
        <div class="bg-black/50 w-full min-h-screen flex flex-col items-center justify-center">
            <div class="w-[500px] w-[500px] bg-white rounded-xl shadow-lg p-6">

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
