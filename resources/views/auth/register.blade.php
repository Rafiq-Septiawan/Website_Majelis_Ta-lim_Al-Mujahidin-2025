<x-guest-layout>
    @section('title', "Daftar Akun")

    <!-- Form Register -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Nama Lengkap -->
        <label class="block mb-1 text-gray-700 text-xs font-bold">Nama Lengkap</label>
        <input type="text" name="name" placeholder="Masukkan nama lengkap" 
               class="w-full p-2 border rounded-xl mb-1 text-xs" required />

        <!-- Email -->
        <label class="block mb-1 text-gray-700 text-xs font-bold">Email</label>
        <input type="email" name="email" placeholder="Masukkan email" 
               class="w-full p-2 border rounded-xl mb-1 text-xs" required />

             <!-- Password -->
            <div class="relative mb-1">
            <label class="block mb-1 text-gray-700 text-xs font-bold">Password</label>
            <input id="password" type="password" name="password" placeholder="Minimal 8 Karakter" 
           class="w-full p-2 border rounded-xl mb-1 text-xs" required />
            
            <!-- Icon mata -->
            <button type="button" onclick="togglePassword('password', 'icon-password')" 
                    class="absolute inset-y-9 right-1 flex items-center pr-3 text-gray-500">
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

            <!-- Konfirmasi Password -->
            <div class="relative mb-1">
            <label class="block mb-1 text-gray-700 text-xs font-bold">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" 
                class="w-full p-2 border rounded-xl mb-1 text-xs" required />
            
            <!-- Icon mata -->
            <button type="button" onclick="togglePassword('password_confirmation', 'icon-password-confirm')" 
                    class="absolute inset-y-9 right-1 flex items-center pr-3 text-gray-500">
                <svg id="icon-password-confirm" xmlns="http://www.w3.org/2000/svg" 
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

            <script>
            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                if (input.type === "password") {
                input.type = "text";
                // ganti icon ke "eye-slash"
                icon.setAttribute("d", "M3.98 8.223A10.477 ... 21"); 
                } else {
                input.type = "password";
                // ganti icon balik ke "eye"
                icon.setAttribute("d", "M2.036 12.322a1.012 ... 0z");
                }
            }
            </script>

        <!-- Dropdown Role -->
        <label class="block mb-1 text-gray-700 text-xs font-bold">Daftar Sebagai</label>
        <select name="role" class="w-full p-2 text-xs border rounded-xl mb-4" required>
            <option value="admin" class="font-bold font-xs">ADMIN</option>
            <option value="santri" class="font-bold">SANTRI</option>
        </select>

        <!-- Tombol -->
        <button type="submit" 
                class="w-full bg-teal-600 text-white py-2 rounded-xl hover:bg-teal-700 transition font-bold text-xs">
            DAFTAR
        </button>
    </form>

    <!-- Footer -->
    <div class="text-center mt-3 text-sm">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
    </div>
    <div class="text-center text-zinc-500 text-xs mt-2">
        © 2025 | Majelis Ta’lim Al-Mujahidin
    </div>
</x-guest-layout>
