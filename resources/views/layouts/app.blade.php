<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Majelis Ta’lim Al-Mujahidin')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-green-50 text-gray-800 overflow-hidden">

    <!-- Container utama -->
    <div class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
        {{-- Konten utama halaman (login, register, forgot password, dll) --}}
        <main class="w-full">
            @yield('content')
        </main>
    </div>

</body>
</html>
