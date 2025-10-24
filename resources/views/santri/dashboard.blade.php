@extends('santri.layouts.santri')

@section('title', 'Dashboard Wali Santri | Majelis Ta\'lim Al-Mujahidin')

@section('content')

    <div class="p-6 min-h-screen mt-12">

        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-10 h-10 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">DASHBOARD SANTRI</h1>
                    <p class="text-sm text-gray-600 mt-1">Pantau pembayaran, aktivitas, dan riwayat transaksi santri</p>
                </div>
            </div>

            <div id="clock"
                class="bg-primary text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-8">

            <!-- Total Tagihan Aktif -->
            <div
                class="bg-gradient-to-r from-red-600 to-rose-400 text-white p-6 py-4 rounded-xl shadow-md flex items-center justify-between transform hover:scale-105 transition-all duration-300">
                <div>
                    <h4 class="text-lg font-semibold">Total Tagihan Aktif</h4>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalTagihanAktif ?? 0, 0, ',', '.') }}</p>

                    <p class="text-sm text-white/80 mt-1">
                        {{ $jumlahTagihanBelumLunas ?? 0 }} tagihan belum lunas
                    </p>
                </div>

                <!-- ICON -->
                <div class="bg-white/20 p-3 rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-9 h-9 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75M9.75 21h4.5A2.25 2.25 0 0 0 16.5 18.75v-1.5A2.25 2.25 0 0 0 14.25 15h-4.5A2.25 2.25 0 0 0 7.5 17.25v1.5A2.25 2.25 0 0 0 9.75 21Zm0-12V4.5a2.25 2.25 0 1 1 4.5 0V9" />
                    </svg>
                </div>
            </div>

            <!-- Total Pembayaran Selesai -->
            <div
                class="bg-gradient-to-r from-emerald-600 to-lime-400 text-white p-6 py-4 rounded-xl shadow-md flex items-center justify-between transform hover:scale-105 transition-all duration-300">
                <div>
                    <h4 class="text-lg font-semibold">Total Pembayaran Selesai</h4>
                    <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalDibayar ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm text-white/80 mt-1">
                        {{ $jumlahPembayaranSelesai ?? 0 }} transaksi selesai
                    </p>
                </div>

                <!-- ICON -->
                <div class="bg-white/20 p-3 rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-9 h-9 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Tagihan Terdekat -->
            <div
                class="bg-gradient-to-r from-sky-600 to-cyan-400 text-white p-6 py-4 rounded-xl shadow-md flex items-center justify-between transform hover:scale-105 transition-all duration-300 relative">
                <div>
                    <h4 class="text-lg font-semibold">Tagihan Terdekat</h4>
                    <p class="text-base mt-1 font-medium">
                        {{ $tagihanTerdekat->bulan ?? '—' }} {{ $tagihanTerdekat->tahun ?? '' }}
                    </p>
                    <p class="text-sm text-white/80 mt-1">
                        Jatuh tempo:
                        {{ isset($tagihanTerdekat->jatuh_tempo) ? \Carbon\Carbon::parse($tagihanTerdekat->jatuh_tempo)->format('d/m/Y') : '-' }}
                    </p>
                </div>

                <!-- ICON + BUTTON -->
                <div class="flex flex-col items-center">
                    <div class="bg-white/20 p-3 rounded-full shadow-md mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pembayaran -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-teal-100">
                <div class="flex items-center gap-4">
                    <div class="bg-gradient-to-br from-teal-500 to-emerald-500 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h3>
                        <p class="text-sm text-gray-600">Detail transaksi pembayaran santri</p>
                    </div>
                </div>
            </div>

            <!-- List Riwayat -->
            <div class="space-y-4">
                @forelse($riwayatPembayaran ?? [] as $index => $pembayaran)
                    <div
                        class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-5 border-l-4 
                            {{ ($pembayaran->status ?? 'Lunas') == 'Lunas' ? 'border-emerald-500' : (($pembayaran->status ?? '') == 'Menunggu' ? 'border-orange-500' : 'border-red-500') }} 
                            hover:shadow-lg transition-all">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div
                                        class="bg-teal-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-lg">
                                            {{ $pembayaran->bulan ?? 'Januari' }} {{ $pembayaran->tahun ?? '2025' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Jatuh tempo:
                                            {{ $pembayaran->jatuh_tempo ? \Carbon\Carbon::parse($pembayaran->jatuh_tempo)->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                </div>

                                @if (($pembayaran->status ?? 'Lunas') == 'Lunas')
                                    <div class="ml-13 mt-2 flex items-center gap-2 text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span>Dibayar:
                                            {{ $pembayaran->tanggal_bayar ? \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y') : '-' }}</span>
                                        <span class="text-gray-400">•</span>
                                        <span>{{ $pembayaran->metode_bayar ?? 'Transfer Bank' }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="text-right">
                                <p class="font-bold text-2xl text-gray-800 mb-2">
                                    Rp {{ number_format($pembayaran->nominal ?? 50000, 0, ',', '.') }}
                                </p>
                                @if (strtolower($pembayaran->status) == 'lunas')
                                    <span class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-bold border-2 border-emerald-300">
                                        ✓ Lunas
                                    </span>
                                @elseif(strtolower($pembayaran->status) == 'menunggu')
                                    <span class="inline-block px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-bold border-2 border-orange-300">
                                        ⏳ Menunggu
                                    </span>
                                @else
                                    <span class="inline-block px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-bold border-2 border-red-300">
                                        ✗ Belum Bayar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div
                        class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-dashed border-gray-300">
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-200 p-6 rounded-full mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Riwayat Pembayaran</h3>
                            <p class="text-gray-500 mb-6 max-w-md">
                                Saat ini belum ada data pembayaran yang tercatat. <br>
                                Silakan lakukan pembayaran pertama Anda.
                            </p>
                            <button onclick="window.location.href='{{ route('santri.pembayaran.index') }}'"
                                class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Mulai Pembayaran
                                </div>
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination if needed -->
            @if (isset($riwayatPembayaran) && method_exists($riwayatPembayaran, 'links'))
                <div class="mt-8 flex justify-center">
                    {{ $riwayatPembayaran->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Update Clock
            function updateClock() {
                const clock = document.getElementById("clock");
                const now = new Date();

                const hari = now.toLocaleDateString('id-ID', {
                    weekday: 'long'
                });
                const tanggal = now.getDate();
                const bulan = now.toLocaleDateString('id-ID', {
                    month: 'long'
                });
                const tahun = now.getFullYear();

                const jam = String(now.getHours()).padStart(2, '0');
                const menit = String(now.getMinutes()).padStart(2, '0');
                const detik = String(now.getSeconds()).padStart(2, '0');

                const waktuLengkap = `${hari}, ${tanggal} ${bulan} ${tahun} • ${jam}:${menit}:${detik}`;
                clock.textContent = waktuLengkap;
            }

            updateClock();
            setInterval(updateClock, 1000);

            // Smooth scroll for buttons
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', function(e) {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
@endsection
