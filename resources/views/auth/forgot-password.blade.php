<x-guest-layout>
    @section('title', "Lupa Password")
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p class="text-center text-sm text-gray-600 mb-6">
            Masukkan email Anda untuk mendapatkan kode OTP
        </p>
        <!-- Email -->
        <label for="email" class="block mb-1 text-gray-700 font-medium">Email</label>
        <input id="email" 
               type="email" 
               name="email" 
               placeholder="Masukkan email" 
               value="{{ old('email') }}" 
               required autofocus
               class="w-full p-2 border rounded-md mb-4 focus:ring focus:ring-teal-400" />

        <x-input-error :messages="$errors->get('email')" class="mb-4" />

        <!-- Tombol Kirim -->
        <button type="submit" 
                class="w-full mt-2 bg-teal-600 text-white py-2 rounded-xl hover:bg-teal-700 transition font-bold">
            KIRIM
        </button>
    </form>

    <!-- Link Kembali -->
    <div class="mt-4">
        <a href="{{ route('login') }}" class="flex items-center text-sm text-gray-600 hover:text-teal-600">
            <!-- Icon panah -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" 
                 class="w-4 h-4 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Kembali Ke Login
        </a>
    </div>
    </form>
     <div class="text-center text-zinc-500 text-xs mt-4">
        © 2025 | Majelis Ta’lim Al-Mujahidin
     </div>
</x-guest-layout>
