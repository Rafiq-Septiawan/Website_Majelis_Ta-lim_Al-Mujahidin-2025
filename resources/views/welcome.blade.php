<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MAJELIS TA'LIM AL-MUJAHIDIN</title>
        @vite('resources/css/app.css')
    </head>
    <body style="background-image: url('{{ asset("images/background.png") }}'); background-size: cover; background-position: center;">
        <div class="flex flex-col items-center justify-center min-h-screen text-center px-6">
            
            <!-- Logo / Judul -->
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 drop-shadow-lg">
                Selamat Datang di <br> Majelis Ta'lim Al-Mujahidin
            </h1>

            <p class="text-lg sm:text-xl mb-8 text-gray-100 max-w-2xl">
                Website informasi dan manajemen kegiatan pengajian anak-anak.
            </p>

            <!-- Tombol -->
            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-6 py-3 border-2 border-white font-semibold rounded-lg hover:bg-white hover:text-indigo-600 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Footer kecil -->
            <footer class="mt-12 text-sm text-gray-200">
                &copy; {{ date('Y') }} Majelis Ta'lim Al-Mujahidin. All rights reserved.
            </footer>
        </div>
    </body>
</html>
