@extends('layouts.app')

@section('title', 'Masuk Akun | Majelis Ta’lim Al-Mujahidin')

@section('content')

<div class="min-h-screen flex items-center justify-center px-3 py-6 relative"
     style="background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">

    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8">
        <div class="flex justify-center -mt-[20px] mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Majelis Ta'lim" class="w-[90px] h-[90px]">
        </div>

        <h2 class="text-xl font-extrabold text-gray-800 text-center mb-2">Lupa Password</h2>
        <p class="text-center text-gray-600 mb-10 text-xs">
            Masukkan email terdaftar. Kami akan mengirimkan tautan untuk mereset password.
        </p>

        @if(session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none text-sm"
                    placeholder="Masukkan email terdaftar" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2.5 rounded-xl font-semibold text-sm transition-shadow shadow-md">
                KIRIM
            </button>
        </form>

        <div class="text-center mt-4 text-sm text-gray-600">
            Ingat akunmu?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Masuk</a>
        </div>
    
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

        <div class="text-center text-gray-400 text-xs mt-8 -mb-[10px]">
            © 2025 | Majelis Ta’lim Al-Mujahidin
        </div>
    </div>
</div>
@endsection
