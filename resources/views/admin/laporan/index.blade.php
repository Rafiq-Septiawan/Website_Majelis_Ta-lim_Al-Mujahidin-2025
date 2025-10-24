@extends('admin.layouts.admin')

@section('title', 'Laporan Keuangan | Majelis Ta\'lim Al-Mujahidin')

@section('content')
<div class="p-6 min-h-screen mt-12">
    
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">LAPORAN KEUANGAN</h1>
                <p class="text-sm text-gray-600 mt-1">Pantau dan analisis seluruh transaksi serta keuangan santri</p>
            </div>
        </div>

        <div class="flex gap-3 no-print">
            <button onclick="cetakPDF()" class="flex items-center gap-2 bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                Cetak PDF
            </button>
        </div>
    </div>

    <!-- Statistik Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
            <div class="bg-gradient-to-br from-teal-500 to-teal-600 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-teal-100 text-sm font-medium mb-2">Total Santri</p>
                        <p class="text-4xl font-bold text-white">{{ $totalSantri ?? 0 }}</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-emerald-100 text-sm font-medium mb-2">Pembayaran Bulan Ini</p>
                        <p class="text-3xl font-bold text-white">Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
            <div class="bg-gradient-to-br from-amber-500 to-orange-600 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-amber-100 text-sm font-medium mb-2">Santri Belum Bayar</p>
                        <p class="text-4xl font-bold text-white">{{ $jumlahBelumBayar ?? 0 }}</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Keuangan -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-10">
        <div class="flex items-center gap-4 mb-6 pb-4 border-b-2 border-teal-100">
            <div class="bg-gradient-to-br from-teal-500 to-emerald-500 p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Ringkasan Keuangan</h2>
                <p class="text-sm text-gray-600">Analisis pendapatan dan pembayaran periode ini</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-5 rounded-xl border-2 border-emerald-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-emerald-500 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Total Pendapatan</p>
                </div>
                <p class="text-2xl font-bold text-emerald-700">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gradient-to-br from-red-50 to-rose-50 p-5 rounded-xl border-2 border-red-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-red-500 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Total Tunggakan</p>
                </div>
                <p class="text-2xl font-bold text-red-700">Rp {{ number_format($totalTunggakan ?? 0, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-5 rounded-xl border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-blue-500 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Jumlah Santri Lunas</p>
                </div>
                <p class="text-2xl font-bold text-blue-700">{{ $jumlahLunas ?? 0 }} Santri</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-violet-50 p-5 rounded-xl border-2 border-purple-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-purple-500 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Persentase Pembayaran</p>
                </div>
                <p class="text-2xl font-bold text-purple-700">{{ $persentasePembayaran ?? 0 }}%</p>
            </div>
        </div>
    </div>

    <!-- Daftar Santri Belum Bayar -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-10">
        <div class="flex items-center gap-4 mb-6 pb-4 border-b-2 border-amber-100">
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Santri Belum Bayar</h2>
                <p class="text-sm text-gray-600">Santri yang memiliki tunggakan pembayaran</p>
            </div>
        </div>

        <div class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-amber-500 scrollbar-track-amber-100 pr-2 space-y-4 mb-10">
            @forelse($santriBelumBayar ?? [] as $index => $santri)
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-5 border-l-4 border-amber-500 hover:shadow-lg transition-all">
                    <div class="flex justify-between items-start">
                        <div class="flex items-start gap-4">
                            <div class="bg-amber-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">{{ $santri->nama ?? 'Nama tidak tersedia' }}</p>
                                <p class="text-sm text-gray-600 mt-1">Wali: {{ $santri->nama_wali ?? $santri->wali ?? '-' }}</p>
                                <p class="text-sm text-gray-600 mt-1">Telepon: {{ $santri->no_hp_wali ?? $santri->telepon ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-bold border-2 border-amber-300">
                                Belum Bayar
                            </span>
                            <p class="text-xs text-gray-500 mt-2 font-medium">
                                Jatuh Tempo: {{ $santri->jatuh_tempo ?? '1 ' . now()->translatedFormat('F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                    <div class="flex flex-col items-center">
                        <svg class="w-20 h-20 text-emerald-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-emerald-700 font-semibold text-lg">Semua santri sudah membayar 🎉</p>
                        <p class="text-sm text-emerald-600 mt-2">Tidak ada tunggakan pembayaran saat ini</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center gap-4 mb-6 pb-4 border-b-2 border-emerald-100">
            <div class="bg-gradient-to-br from-emerald-500 to-teal-500 p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h2>
                <p class="text-sm text-gray-600">Detail transaksi pembayaran santri</p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border-2 border-emerald-100">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">No</th>
                        <th class="px-6 py-4 text-left font-bold">Tanggal</th>
                        <th class="px-6 py-4 text-left font-bold">Nama Santri</th>
                        <th class="px-6 py-4 text-left font-bold">Jenis Pembayaran</th>
                        <th class="px-6 py-4 text-left font-bold">Nominal</th>
                        <th class="px-6 py-4 text-center font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($riwayatPembayaran ?? [] as $index => $bayar)
                        <tr class="hover:bg-emerald-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                @if(isset($bayar->tanggal_bayar))
                                    {{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d/m/Y') }}
                                @elseif(isset($bayar->tanggal))
                                    {{ \Carbon\Carbon::parse($bayar->tanggal)->format('d/m/Y') }}
                                @elseif(isset($bayar->created_at))
                                    {{ \Carbon\Carbon::parse($bayar->created_at)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $bayar->santri->nama ?? 'Tidak Diketahui' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $bayar->jenis_pembayaran ?? 'SPP' }}</td>
                            <td class="px-6 py-4 font-bold text-emerald-600">
                                Rp {{ number_format($bayar->jumlah_bayar ?? $bayar->jumlah ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(($bayar->status ?? 'Lunas') === 'Lunas')
                                    <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-300">
                                        Lunas
                                    </span>
                                @elseif(($bayar->status ?? '') === 'Belum Bayar')
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold border border-red-300">
                                        Belum Bayar
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold border border-yellow-300">
                                        Terlambat
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-lg font-medium italic">Tidak ada riwayat pembayaran</p>
                                    <p class="text-sm mt-2">Belum ada transaksi yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination if needed -->
        @if(isset($riwayatPembayaran) && method_exists($riwayatPembayaran, 'links'))
            <div class="mt-6">
                {{ $riwayatPembayaran->links() }}
            </div>
        @endif
    </div>

<!-- Print Styles -->
<style>
@media print {
    /* Sembunyikan semua tampilan web bergaya card */
    .p-6 > * { display: none !important; }

    /* Buat versi tabel cetak */
    .pdf-report {
        display: block !important;
        padding: 20mm;
        font-family: "Arial", sans-serif;
        color: #000;
    }

    .pdf-report h1 {
        text-align: center;
        font-size: 18pt;
        margin-bottom: 5mm;
    }

    .pdf-report p {
        text-align: center;
        font-size: 10pt;
        margin-bottom: 10mm;
    }

    .pdf-report table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
        margin-bottom: 10mm;
    }

    .pdf-report th, .pdf-report td {
        border: 1px solid #555;
        padding: 6px 8px;
    }

    .pdf-report th {
        background-color: #0d9488 !important;
        color: white !important;
    }

    .pdf-report tfoot td {
        border-top: 2px solid #555;
        font-weight: bold;
    }
}

    .scrollbar-thin::-webkit-scrollbar {
        width: 12px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: #0d9488;
        border-radius: 30px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background-color: #6f6f6f;
        border-radius: 35px;
    }
</style>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function cetakPDF() {
    // Sembunyikan tombol cetak
    const noPrintElements = document.querySelectorAll('.no-print');
    noPrintElements.forEach(el => el.style.display = 'none');
    
    const element = document.querySelector('.p-6');
    const opt = {
        margin: [0.5, 0.5, 0.5, 0.5],
        filename: 'Laporan_Keuangan_Majelis_Talim_Al-Mujahidin_' + new Date().toLocaleDateString('id-ID').replace(/\//g, '-') + '.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
            scale: 2,
            useCORS: true,
            letterRendering: true 
        },
        jsPDF: { 
            unit: 'in', 
            format: 'a4', 
            orientation: 'portrait' 
        },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };
    
    html2pdf().set(opt).from(element).save().then(() => {
        // Tampilkan kembali tombol cetak setelah PDF selesai
        noPrintElements.forEach(el => el.style.display = '');
    });
}

// Alternative: Print using browser print dialog
function cetakBrowser() {
    window.print();
}

// Keyboard shortcut for print (Ctrl+P)
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        cetakPDF();
    }
});
</script>

@endsection