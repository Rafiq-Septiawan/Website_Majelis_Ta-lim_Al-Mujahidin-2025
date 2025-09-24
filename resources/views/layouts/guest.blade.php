<!DOCTYPE html>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', "REGISTER")</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans overflow-hidden">
    <!-- Background dengan overlay -->
    <div class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center"
         style="background-image: url({{ asset('images/background.png') }})">

        <!-- Overlay gelap -->
        <div class="bg-black bg-opacity-50 w-full min-h-screen flex flex-col items-center justify-center">
            
            <!-- Kotak form -->
            <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-4 max-h-[650px] max-w-[400px]">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[110px] w-auto">
                </div>

                <!-- Content (Login/Register Form) -->
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
