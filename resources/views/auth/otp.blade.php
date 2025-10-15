<x-guest-layout>
    @section('title', "Verifikasi OTP")
 
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Majelis Ta'lim"
                 class="w-[80px] h-[80px] mb-4 drop-shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 text-center tracking-wide">Verifikasi OTP</h2>
            <p class="text-sm text-gray-500 mt-1 text-center">
                Masukkan kode OTP yang telah dikirim ke email
            </p>
        </div>

        @if(session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form id="otpForm" method="POST" action="{{ route('otp.verify') }}" class="space-y-4">
            @csrf

            <!-- Input OTP (4 box) -->
            <div class="flex justify-center space-x-4">
                @for($i = 1; $i <= 4; $i++)
                    <input type="text" maxlength="1"
                           class="otp-input w-8 h-8 mb-2 text-center border rounded-xl text-sm focus:ring-1 focus:ring-teal-500"
                           oninput="moveNext(this, {{ $i }})"
                           onkeydown="movePrev(event, this, {{ $i }})">
                @endfor
            </div>

            <!-- Hidden field untuk gabungan OTP -->
            <input type="hidden" name="otp" id="otp">

            <button type="submit" 
                class="w-full mt-4 bg-teal-600 text-white py-2 rounded-xl hover:bg-teal-700 transition font-bold">
            VERIFIKASI
            </button>
        </form>

        <div class="text-center mt-4 mb-6 text-sm text-gray-600">
            Tidak menerima kode OTP?
            <a href="{{ route('otp.generate') }}" class="text-blue-700">Kirim Ulang</a>
        </div>

                <!-- Link Kembali -->
            <a href="{{ route('login') }}" 
            class="absolute top-4 left-4 flex items-center text-xs text-gray-600 hover:text-teal-600">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" 
                    class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Kembali 
            </a>
        <div class="text-center text-zinc-500 text-xs mt-4">
        © 2025 | Majelis Ta’lim Al-Mujahidin
    </div>
</x-guest-layout>
