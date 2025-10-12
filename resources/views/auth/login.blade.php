@extends('layouts.app')

@section('title', 'Masuk Akun | Majelis Ta’lim Al-Mujahidin')

@section('content')

<div class="min-h-screen flex items-center justify-center px-3 py-6 relative"
     style="background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Card -->
    <div class="relative z-10 w-full max-w-md bg-white/95 backdrop-blur-xl shadow-2xl rounded-2xl p-8
                transition-all duration-300 hover:shadow-[0_0_25px_rgba(0,0,0,0.1)]">

        <!-- Logo & Judul -->
        <div class="flex flex-col items-center -mt-[20px] mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Majelis Ta'lim"
                 class="w-[80px] h-[80px] mb-4 drop-shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 text-center tracking-wide">Masuk Akun</h2>
            <p class="text-sm text-gray-500 mt-1 text-center">
                Masuk untuk mengelola data dan informasi santri dengan mudah
            </p>
        </div>

        <!-- Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Email</label>
                <input id="email" type="email" name="email" placeholder="Masukkan email"
                       class="w-full p-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-teal-500 outline-none"
                       required autofocus>
                @error('email')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Password</label>
                <input id="password" type="password" name="password" placeholder="Masukkan password"
                       class="w-full p-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-teal-500 outline-none"
                       required>
                <button type="button" onclick="togglePassword('password', 'icon-password')" 
                        class="absolute inset-y-[40px] right-4 flex items-center text-teal-600">
                    <svg id="icon-password" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.036 12.322a1.012 1.012 0 010-.639
                              C3.423 7.51 7.36 4.5 12 4.5
                              c4.637 0 8.573 3.007 9.963 7.178
                              .07.207.07.431 0 .639
                              C20.577 16.49 16.64 19.5 12 19.5
                              c-4.637 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
                @error('password')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me dan Lupa Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-xs text-gray-600">
                    <input type="checkbox" name="remember"
                           class="mr-1 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                    Ingat saya
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs text-teal-600 font-semibold hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol -->
            <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 rounded-xl 
                           text-sm shadow-md transition duration-200">
                MASUK
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-7 text-[12px] text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:underline">
                Daftar di sini
            </a>
        </div>

        <footer class="text-center text-gray-400 text-[10px] -mb-[20px] mt-[20px]">© 2025 | Majelis Ta’lim Al-Mujahidin</footer>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.98 8.223A10.477 10.477 0 0 0 1.75 12
                c1.658 4.05 5.523 7.5 10.25 7.5
                2.042 0 3.937-.614 5.535-1.663M9.88 9.883
                A3 3 0 0 0 12 15a3 3 0 0 0 2.12-.878M6.18 6.18
                3 3m0 0 18 18"/>`;
    } else {
        input.type = "password";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.036 12.322a1.012 1.012 0 010-.639
                C3.423 7.51 7.36 4.5 12 4.5
                c4.637 0 8.573 3.007 9.963 7.178
                .07.207.07.431 0 .639
                C20.577 16.49 16.64 19.5 12 19.5
                c-4.637 0-8.573-3.007-9.963-7.178z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`;
    }
}
</script>
@endsection
