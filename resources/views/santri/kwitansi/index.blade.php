@extends('santri.layouts.santri')

@section("title", "Kwitansi | Majelis Ta'lim Al-Mujahidin")

@section('content')
@php
    \Carbon\Carbon::setLocale('id');
@endphp

<div class="p-6 min-h-screen mt-12">
    <div class="flex items-center gap-4 mb-10">
        <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
              <path stroke-linecap="round" stroke-linejoin="round" d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">KWITANSI</h1>
            <p class="text-sm text-gray-600 mt-1">Dokumentasi resmi setiap transaksi pembayaran</p>
        </div>
    </div>

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
        <strong>Error:</strong> {{ session('error') }}
    </div>
    @endif

    @if(isset($error))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
        <strong>Error:</strong> {{ $error }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border-l-4 border-emerald-500">
        <div class="flex items-center gap-4">
            <div class="bg-emerald-100 p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800">{{ $santri->nama ?? 'Nama Santri' }}</h3>
                <p class="text-sm text-gray-600">Wali: {{ $santri->wali ?? '-' }}</p>
                <p class="text-sm text-gray-600">Telepon: {{ $santri->telepon ?? '-' }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500">Total Kwitansi</p>
                <p class="text-2xl font-bold text-emerald-600">{{ $kwitansis->count() }}</p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($kwitansis as $kwitansi)
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow border border-gray-200">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4 pb-4 border-b border-dashed">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                                LUNAS
                            </span>
                            <span class="text-xs text-gray-500">
                                #{{ str_pad($kwitansi->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <p class="text-lg font-bold text-gray-800">
                            Pembayaran {{ $kwitansi->bulan_bayar ?? 'SPP' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($kwitansi->tanggal_bayar)->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 mb-1">Total Bayar</p>
                        <p class="text-2xl font-bold text-emerald-600">
                            Rp {{ number_format($kwitansi->jumlah_bayar ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4 text-sm">
                    <div>
                        <p class="text-gray-500 mb-1">Nama Santri</p>
                        <p class="font-semibold text-gray-800">{{ $santri->nama ?? 'Nama tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Bulan</p>
                        <p class="font-semibold text-gray-800">{{ bulanIndonesia($kwitansi->bulan) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Metode</p>
                        <p class="font-semibold text-gray-800">
                            @if(!empty($kwitansi->metode_bayar))
                                {{ ucfirst($kwitansi->metode_bayar) }}
                            @else
                                Tunai
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('santri.kwitansi.cetak', $kwitansi->id) }}" 
                       target="_blank"
                       class="flex-1 bg-primary text-white font-semibold py-2.5 px-4 rounded-lg transition-colors text-center">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Kwitansi
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @empty

        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="inline-block p-6 bg-gray-50 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Kwitansi</h3>
            <p class="text-gray-600 mb-6">Kwitansi akan muncul setelah Anda melakukan pembayaran</p>
            <a href="{{ route('santri.pembayaran.index') }}" 
               class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                Lakukan Pembayaran
            </a>
        </div>
        @endforelse
    </div>

    @if($kwitansis->count() > 0)
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $kwitansis->count() }}</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($kwitansis->sum('jumlah_bayar'), 0, ',', '.') }}</p>
                </div>
                <div class="bg-emerald-50 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Terakhir Bayar</p>
                    <p class="text-lg font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($kwitansis->first()->tanggal_bayar)->isoFormat('D MMMM Y') }}
                    </p>
                </div>
                <div class="bg-purple-50 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@php
function bulanIndonesia($bulanInggris) {
    $bulan = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];
    return $bulan[$bulanInggris] ?? $bulanInggris;
}
@endphp

@endsection
