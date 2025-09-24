<x-guest-layout>
    @section('title', "Verifikasi OTP")
        <h2 class="text-center text-xl font-bold mb-4">VERIFIKASI OTP</h2>
        <p class="text-center text-gray-600 mb-6">Masukkan kode OTP yang telah dikirim ke email</p>

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

        <div class="mb-8">
            <a href="{{ route('password.request') }}" class="flex items-center text-sm text-gray-600">
                ← Kembali Ke Lupa Password
            </a>
        </div>
        <div class="text-center text-zinc-500 text-xs mt-4">
        © 2025 | Majelis Ta’lim Al-Mujahidin
    </div>
</x-guest-layout>
