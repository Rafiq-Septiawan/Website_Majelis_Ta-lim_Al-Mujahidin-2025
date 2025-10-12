@extends('admin.layouts.admin')

@section('title', 'Laporan Keuangan | Majelis Ta’lim Al-Mujahidin')

@section('content')

    <!-- Konten -->
        <div class="p-6 bg-white rounded-2xl">
            
            <!-- Header dengan Tombol Action -->
            <div class="flex items-center justify-between mt-[65px] mb-6">
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-r from-teal-500 to-emerald-500 p-3 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">LAPORAN KEUANGAN</h1>
                        <p class="text-sm text-gray-500">Analisis Pembayaran dan Keuangan Santri</p>
                    </div>
                </div>

                <div class="flex gap-3 no-print">
                    <!-- Filter Tahun -->
                    <select id="filterTahun" class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 font-semibold">
                        <option value="">Semua Tahun</option>
                        <option value="2025" selected>2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>

                    <!-- Tombol Cetak PDF -->
                    <button onclick="cetakPDF()" class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-5 py-2 rounded-lg shadow-md hover:shadow-lg transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Cetak PDF
                    </button>
                </div>
            </div>

            <!-- Area yang akan dicetak -->
            <div id="laporanContent">
                
                <!-- Statistik Card -->
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <!-- Total Santri -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Total Santri</p>
                                <p class="text-4xl font-bold mt-2">{{ $totalSantri ?? 0 }}</p>
                                <p class="text-xs mt-2 opacity-75">+12% dari bulan lalu</p>
                            </div>
                            <div class="bg-white/20 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran Bulan Ini -->
                    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Pembayaran Bulan Ini</p>
                                <p class="text-4xl font-bold mt-2">Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}</p>
                                <p class="text-xs mt-2 opacity-75">+5% dari target</p>
                            </div>
                            <div class="bg-white/20 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tunggakan -->
                    <div class="bg-gradient-to-br from-orange-500 to-red-500 text-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Tunggakan</p>
                                <p class="text-4xl font-bold mt-2">{{ $jumlahBelumBayar ?? 0 }}</p>
                                <p class="text-xs mt-2 opacity-75">Santri dengan tunggakan</p>
                            </div>
                            <div class="bg-white/20 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Santri Menunggak -->
                <div class="bg-gradient-to-br from-rose-50 to-red-50 border-2 border-rose-200 p-6 rounded-xl shadow-md mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-rose-500 p-2.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Daftar Santri Menunggak</h2>
                            <p class="text-sm text-gray-600">Santri yang memiliki tunggakan pembayaran</p>
                        </div>
                    </div>

                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @forelse($santriBelumBayar ?? [] as $santri)
                            <div class="bg-white rounded-lg p-4 border-l-4 border-rose-500 shadow-sm hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-gray-800 text-lg">{{ $santri->nama }}</p>
                                        <p class="text-sm text-gray-600 mt-1">Wali: {{ $santri->wali }}</p>
                                        <p class="text-sm text-gray-500">📞 {{ $santri->nomor_telepon }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block px-4 py-1.5 bg-rose-100 text-rose-700 rounded-full text-sm font-semibold">
                                            Belum Bayar
                                        </span>
                                        <p class="text-xs text-gray-500 mt-2">Tidak ada riwayat pembayaran</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p class="text-gray-400 italic">Semua santri sudah membayar! 🎉</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <footer class="text-zinc-400 text-xs text-center mt-6">© 2025 | Majelis Ta'lim Al-Mujahidin</footer>
        </div>
    </div>


    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }

        // Fungsi Cetak PDF
        function cetakPDF() {
            const element = document.getElementById('laporanContent');
            const tahun = document.getElementById('filterTahun').value || 'Semua';
            
            const opt = {
                margin: 10,
                filename: `Laporan_Keuangan_${tahun}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait'
                        };
            html2pdf().set(opt).from(element).save();
        }

        // Filter tahun (simulasi)
        document.getElementById('filterTahun').addEventListener('change', function() {
            const tahun = this.value;
            // Kamu bisa ganti logika di bawah ini dengan request AJAX ke server
            alert(`Menampilkan laporan tahun ${tahun || 'semua tahun'}`);
        });
    </script>
        
@endsection
