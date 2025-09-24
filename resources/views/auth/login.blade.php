{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    @section('title', "Login")

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <label class="block mb-1 text-gray-700 text-sm font-bold">Email</label>
        <input id="email" type="email" name="email" 
               value="{{ old('email') }}" required autofocus 
               class="w-full p-2 border rounded-xl mb-3 text-sm"
               placeholder="Masukkan email" />

        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <!-- Password -->
        <div class="relative mb-1">
            <label class="block mb-1 text-gray-700 text-sm font-bold">Password</label>
        <input id="password" type="password" name="password" required 
               class="w-full p-2 border rounded-xl mb-3 text-sm"
               placeholder="Masukkan password" />

        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <!-- Icon mata -->
        <button type="button" onclick="togglePassword('password', 'icon-password')" 
            class="absolute inset-y-11 right-1 flex items-center pr-3 text-gray-500">
            <svg id="icon-password" xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 
                        7.36 4.5 12 4.5c4.637 0 8.573 3.007 
                        9.963 7.178.07.207.07.431 0 
                        .639C20.577 16.49 16.64 19.5 
                        12 19.5c-4.637 0-8.573-3.007-9.963-7.178z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>
        
        <script>function togglePassword(inputId, pathId) {
            const input = document.getElementById(inputId);
            const path = document.getElementById(pathId);

            if (input.type === "password") {
                input.type = "text";
                // eye slash
                path.setAttribute("d", "M3.98 8.223A10.477 ...");
            } else {
                input.type = "password";
                // eye
                path.setAttribute("d", "M2.036 12.322a1.012...");
            }
        }
        </script>
        <!-- Remember Me -->
        <div class="flex items-center mb-3">
            <input id="remember_me" type="checkbox" name="remember" 
                   class="mr-2 rounded border-gray-300 text-teal-600 focus:ring-teal-500" />
            <label for="remember_me" class="text-sm text-gray-600">Ingat saya</label>
        </div>

        <!-- Footer Form -->
        <div class="flex items-center justify-between text-sm">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-blue-600 hover:underline">Lupa password?</a>
            @endif

            <a href="{{ route('register') }}" 
               class="text-blue-600 hover:underline">Belum punya akun? Daftar di sini</a>
        </div>

        <!-- Tombol -->
        <button type="submit" 
                class="w-full mt-4 bg-teal-600 text-white py-2 rounded-xl hover:bg-teal-700 transition font-bold">
            MASUK
        </button>
    </form>
    <div class="text-center text-zinc-500 text-xs mt-4">
        © 2025 | Majelis Ta’lim Al-Mujahidin
    </div>
</x-guest-layout>
