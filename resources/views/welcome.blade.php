<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Selamat Datang👋</title>
    @vite('resources/css/app.css')
    
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-cover bg-center relative" 
      style="background-image: url('{{ asset("images/background.png") }}');">

    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Konten Utama -->
    <main class="flex flex-col flex-grow items-center justify-center text-center px-6 relative z-10">
        
        <!-- Judul -->
        <h1 class="text-5xl sm:text-7xl font-bold mb-6 text-white opacity-0 animate-fadeInUp drop-shadow-2xl">
            Selamat Datang
        </h1>
        
        <h2 class="text-2xl sm:text-4xl font-semibold mb-8 text-emerald-300 opacity-0 animate-fadeInUp delay-100 drop-shadow-lg">
            di Majelis Ta'lim Al-Mujahidin
        </h2>

        <!-- Deskripsi -->
        <p class="text-lg sm:text-xl mb-12 text-white opacity-0 animate-fadeInUp delay-200 max-w-2xl drop-shadow-lg">
            Media informasi pembayaran majelis ta'lim al-mujahidin.
        </p>

        <!-- Tombol -->
        <div class="flex flex-col sm:flex-row gap-4 opacity-0 animate-fadeInUp delay-300">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-8 py-4 rounded-full bg-white text-zinc-900 font-semibold shadow-2xl hover:shadow-white/30 transition-all duration-300 transform hover:scale-105">
                        Masuk ke Dashboard
                    </a>
                @else
                    {{-- Kalau belum login --}}
                    <a href="{{ route('login') }}" 
                       class="px-8 py-4 rounded-full bg-white text-zinc-900 font-semibold shadow-2xl hover:shadow-white/30 transition-all duration-300 transform hover:scale-105">
                        MASUK
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 rounded-full bg-emerald-500 text-white font-semibold shadow-2xl hover:shadow-emerald-500/50 transition-all duration-300 transform hover:scale-105">
                            DAFTAR
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 text-sm text-white text-center relative z-10">
        <p>&copy; {{ date('Y') }} Majelis Ta'lim Al-Mujahidin</p>
    </footer>
</body>
</html>