<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Selamat Datang👋</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-cover bg-center" 
      style="background-image: url('{{ asset("images/background.png") }}');">

    <!-- Konten Utama -->
    <main class="flex flex-col flex-grow items-center justify-center text-center px-6">
        
        <!-- Logo / Judul -->
        <h1 class="text-4xl sm:text-7xl font-bold mb-4 drop-shadow-lg text-white">
            Selamat Datang <br>di Majelis Ta'lim Al-Mujahidin
        </h1>

        <p class="text-lg sm:text-xl mb-8 text-neutral-50 max-w-2xl drop-shadow">
            Media informasi pembayaran majelis ta'lim al-mujahidin.
        </p>

        <!-- Tombol -->
        <div class="flex space-x-4">
            @if (Route::has('login'))
                @auth
                    {{-- Kalau user sudah login, arahkan sesuai role (sementara admin dulu) --}}
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-6 py-3 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold shadow-lg hover:opacity-90 transition transform hover:scale-105">
                        Masuk ke Dashboard
                    </a>
                @else
                    {{-- Kalau belum login --}}
                    <a href="{{ route('login') }}" 
                       class="px-6 py-3 rounded-full bg-white text-zinc-900 font-semibold shadow-lg hover:opacity-90 transition transform hover:scale-105">
                        MASUK
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-6 py-3 rounded-full bg-white text-zinc-900 font-semibold shadow-lg hover:opacity-90 transition transform hover:scale-105">
                            DAFTAR
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 font-semibold text-sm text-zinc-950 text-center mt-auto">
        &copy; {{ date('Y') }} Majelis Ta'lim Al-Mujahidin
    </footer>
</body>
</html>
