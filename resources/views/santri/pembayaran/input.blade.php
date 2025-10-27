@extends('santri.layouts.santri')

@section('title', 'Pembayaran SPP | Majelis Ta\'lim Al-Mujahidin')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/pembayaranSPP.css'])
    @vite(['resources/js/pembayaranSPP.js'])
@endpush

@section('content')

@php
$bulanIndo = [
    'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
    'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
    'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
    'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
];
@endphp

<div class="p-6 min-h-screen mt-12">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">PEMBAYARAN SPP</h1>
                <p class="text-sm text-gray-600 mt-1">Lunasi tagihan dengan mudah, cepat, dan aman</p>
            </div>
        </div>
        <button onclick="goBack()" class="flex items-center bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
            Kembali
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6 slide-in border-l-4 border-teal-500">
                <div class="flex items-center gap-4 mb-4 pb-4 border-b">
                    <div class="relative">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=14b8a6&color=fff&size=64' }}" 
                             class="w-16 h-16 rounded-full border-4 border-teal-100 shadow-md">
                        <div class="absolute -bottom-1 -right-1 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-600 flex items-center gap-1">
                            ID : {{ Auth::user()->username ?? 'STR-' . Auth::id() }}
                        </p>
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Email
                        </span>
                        <span class="font-semibold text-gray-800">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Telepon
                        </span>
                        <span class="font-semibold text-gray-800">{{ Auth::user()->santri->telepon ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-xl shadow-xl p-6 text-white slide-in">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Tagihan Aktif
                    </h3>
                    <span class="bg-white/20 backdrop-blur px-3 py-1.5 rounded-full text-sm font-bold flex items-center gap-1 pulse-animation">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        {{ $tagihanBelumLunas->count() }} Bulan
                    </span>
                </div>
                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    @forelse($tagihanBelumLunas as $tagihan)
                    <div class="bg-white/10 backdrop-blur rounded-lg p-3 hover:bg-white/20 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="font-semibold flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $bulanIndo[$tagihan->bulan] ?? $tagihan->bulan }}
                                </span>
                                <p class="text-xs flex items-center gap-1 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Jatuh tempo: {{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->format('d M Y') }}
                                </p>
                            </div>
                            <span class="font-bold text-lg">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-lg font-semibold">Semua tagihan sudah lunas</p>
                    </div>
                    @endforelse
                </div>
                <div class="border-t border-white/30 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                            </svg>
                            Total Tagihan:
                        </span>
                        <span class="text-3xl font-bold">Rp {{ number_format($tagihanBelumLunas->sum('nominal'), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-xl p-8 slide-in">
                <div class="flex items-center justify-between mb-8">
                    <div class="payment-step active flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-teal-500 text-white flex items-center justify-center font-bold">1</div>
                        <span class="font-semibold text-gray-700">Pilih Tagihan</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="payment-step flex items-center gap-2" id="step2">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">2</div>
                        <span class="font-semibold text-gray-500">Metode Bayar</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="payment-step flex items-center gap-2" id="step3">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
                        <span class="font-semibold text-gray-500">Konfirmasi</span>
                    </div>
                </div>

                <form id="pembayaranForm" action="{{ route('santri.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="selectedTagihanIdsContainer" style="display:none;"></div>
                    
                    <input type="hidden" name="metode_bayar" id="metode_bayar">
                    <input type="hidden" name="santri_id" value="{{ $santri->id }}">
                    <input type="hidden" name="bulan" id="bulan">
                    <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">
                    <input type="hidden" name="nominal" id="nominal">

                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Pilih Tagihan yang Akan Dibayar
                        </label>
                        <div class="space-y-3 max-h-64 overflow-y-auto p-2">
                            @foreach($tagihanBelumLunas as $tagihan)
                            <label class="block cursor-pointer">
                                <input 
                                type="checkbox" 
                                name="selected_tagihan[]" 
                                value="{{ $tagihan->id }}" 
                                data-nominal="{{ $tagihan->nominal }}" 
                                data-bulan="{{ $tagihan->bulan }}" 
                                data-tahun="{{ $tagihan->tahun }}" 
                                onchange="updateTotal()" 
                                class="hidden tagihan-checkbox">
                                <div class="tagihan-card flex justify-between items-center p-4 border-2 border-gray-200 rounded-xl hover:border-teal-300 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $bulanIndo[$tagihan->bulan] ?? $tagihan->bulan }}</p>
                                            <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                Jatuh tempo: {{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-xl text-teal-600">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <div class="mt-4 p-5 bg-gradient-to-r from-teal-50 to-emerald-50 border-2 border-teal-200 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-700 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-teal-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                    </svg>
                                    Total Pembayaran:
                                </span>
                                <span class="text-3xl font-bold text-teal-600" id="totalPembayaran">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Pilih Metode Pembayaran
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="payment-method border-2 border-gray-200 rounded-xl p-5 relative" onclick="selectPayment(event,'QRIS')">
                                <div class="check-mark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="method-icon w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"/>
                                        <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z"/>
                                    </svg>
                                </div>
                                <h4 class="text-center font-bold text-gray-700">QRIS</h4>
                                <p class="text-xs text-center text-gray-500 mt-1">Scan & bayar instan</p>
                            </div>

                            <div class="payment-method border-2 border-gray-200 rounded-xl p-5 relative" onclick="selectPayment(event,'Transfer Bank')">
                                <div class="check-mark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="method-icon w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="text-center font-bold text-gray-700">Transfer Bank</h4>
                                <p class="text-xs text-center text-gray-500 mt-1">Transfer via ATM/m-banking</p>
                            </div>

                            <div class="payment-method border-2 border-gray-200 rounded-xl p-5 relative" onclick="selectPayment(event,'E-Wallet')">
                                <div class="check-mark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="method-icon w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="text-center font-bold text-gray-700">E-Wallet</h4>
                                <p class="text-xs text-center text-gray-500 mt-1">OVO, GoPay, Dana, dll</p>
                            </div>

                            <div class="payment-method border-2 border-gray-200 rounded-xl p-5 relative" onclick="selectPayment(event,'Tunai')">
                                <div class="check-mark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="method-icon w-12 h-12 bg-gradient-to-br from-orange-100 to-red-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-orange-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="text-center font-bold text-gray-700">Bayar Tunai</h4>
                                <p class="text-xs text-center text-gray-500 mt-1">Bayar di kasir</p>
                            </div>
                        </div>
                    </div>

                    <div id="paymentDetail" class="hidden mb-8 fade-in"></div>
                    <button id="btnSubmit" type="button" disabled
                        class="w-full bg-gray-400 text-white font-bold py-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Konfirmasi Pembayaran
                    </button>
                    @if ($errors->any())
                        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative">
                            <p class="font-bold">Gagal menyimpan pembayaran:</p>
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if(session('success'))
        window.flashMessage = {
            type: 'success',
            message: '{{ session('success') }}'
        };
    @elseif(session('error'))
        window.flashMessage = {
            type: 'error',
            message: '{{ session('error') }}'
        };
    @elseif(session('info'))
        window.flashMessage = {
            type: 'info',
            message: '{{ session('info') }}'
        };
    @endif
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.flashMessage) {
        const { type, message } = window.flashMessage;
        Swal.fire({
            icon: type,
            title: type === 'success' ? 'Berhasil!' : (type === 'error' ? 'Gagal!' : 'Info'),
            html: message,
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
        });
    }
});
</script>
@endpush