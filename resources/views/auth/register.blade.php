@extends('layouts.app')

@section('title', 'Masuk Akun | Majelis Ta’lim Al-Mujahidin')

@section('content')

<div class="min-h-screen flex items-center justify-center px-3 py-6 relative overflow-y-hidden"
     style="background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Card -->
    <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl p-6 -mt-[15px]
                transition-all duration-300 hover:shadow-[0_0_25px_rgba(0,0,0,0.1)]">

        <!-- Judul & Logo -->
        <div class="flex flex-col items-center mb-5">
            <img src="/images/logo.png" alt="Logo Majelis Ta'lim" class="w-[70px] h-[70px] mb-4 -mt-[15px]">
            <h2 class="text-xl font-semibold text-gray-800 text-center tracking-wide">Daftar Akun</h2>
            <p class="text-[11px] text-gray-500 mt-1 text-center mb-2">
                Daftar sekarang untuk mulai mengakses sistem
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf

            <div>
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap"
                       class="w-full p-2 border rounded-xl text-xs focus:ring-2 focus:ring-teal-500 outline-none" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Email</label>
                <input type="email" name="email" placeholder="Masukkan email"
                       class="w-full p-2 border rounded-xl text-xs focus:ring-2 focus:ring-teal-500 outline-none" required>
            </div>

            <div class="relative">
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Password</label>
                <input id="password" type="password" name="password" placeholder="Minimal 8 karakter"
                       class="w-full p-2 border rounded-xl text-xs focus:ring-2 focus:ring-teal-500 outline-none" required>
                <button type="button" onclick="togglePassword('password', 'icon-password')" 
                        class="absolute inset-y-9 right-4 flex items-center text-gray-500">
                    <svg id="icon-password" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-4 h-4">
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
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password"
                    class="w-full p-2 border rounded-xl text-xs focus:ring-2 focus:ring-teal-500 outline-none" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-xs font-semibold">Daftar Sebagai</label>
                <select name="role"
                        class="w-full p-2 text-xs border rounded-xl focus:ring-2 focus:ring-teal-500 outline-none" required>
                    <option value="admin">Admin</option>
                    <option value="santri">Santri</option>
                </select>  
            </div>

            <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold ml-[2px] py-1.5 w-[397px] rounded-xl 
                           text-sm shadow-md transition duration-200">
                DAFTAR
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-7 text-[12px] text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">Masuk di sini</a>
        </div>

        <div class="text-center text-gray-400 text-[10px] mt-4 -mb-[10px]">
            © 2025 | Majelis Ta’lim Al-Mujahidin
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

    <style>
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='14' width='14' xmlns='http://www.w3.org/2000/svg'><polygon points='0,0 14,0 7,8'/></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-color: white;
            padding-right: 2.2rem;
        }
    </style>

@endsection
