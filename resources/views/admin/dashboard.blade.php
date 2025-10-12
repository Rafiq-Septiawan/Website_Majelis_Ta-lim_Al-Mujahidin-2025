@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin | Majelis Ta’lim Al-Mujahidin')

@section('content')

    <!-- Konten -->
    <div class="p-4 bg-white rounded-2xl p-2">
        <h1 class="font-bold text-2xl text-stone-950 mb-6 mt-[65px]">Selamat Datang, Admin</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-4 gap-8 mb-8">
        <!-- Total Santri -->
        <div class="bg-gradient-to-r from-blue-600 to-sky-300 text-white p-6 py-2 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold">Total Santri</h4>
                <p class="text-2xl font-bold mt-1">{{ $totalSantri ?? 0 }}</p>
            </div>

            <!-- ICON -->
            <div class="bg-white/20 p-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" 
                    class="w-9 h-9 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 
                        3.198.001.031c0 .225-.012.447-.037.666A11.944 
                        11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 
                        6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 
                        0A5.995 5.995 0 0 0 12 12.75a5.995 
                        5.995 0 0 0-5.058 2.772m0 
                        0a3 3 0 0 0-4.681 2.72 8.986 
                        8.986 0 0 0 3.74.477m.94-3.197a5.971 
                        5.971 0 0 0-.94 3.197M15 
                        6.75a3 3 0 1 1-6 0 3 3 
                        0 0 1 6 0Zm6 3a2.25 2.25 0 
                        1 1-4.5 0 2.25 2.25 0 
                        0 1 4.5 0Zm-13.5 0a2.25 
                        2.25 0 1 1-4.5 0 2.25 
                        2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
        </div>

        <!-- Lunas -->
        <div class="bg-gradient-to-r from-green-700 to-lime-500 text-white p-6 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold">Sudah Bayar</h4>
                <p class="text-2xl font-bold mt-1">{{ $sudahLunas ?? 0 }}</p>
            </div>

            <!-- ICON -->
            <div class="bg-white/20 p-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-9 h-9 text-white">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="
                            M9 12.75 
                            L11.25 15 
                            L15 9.75
                            M21 12
                            a9 9 0 1 1-18 0
                            a9 9 0 0 1 18 0Z
                        " />
                </svg>
            </div>
        </div>

        <!-- Belum Bayar -->
        <div class="bg-gradient-to-r from-orange-600 to-amber-300 text-white p-6 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold">Belum Bayar</h4>
                <p class="text-2xl font-bold mt-1">{{ $jumlahBelumBayar ?? 0 }}</p>
            </div>

            <!-- ICON -->
            <div class="bg-white/20 p-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-9 h-9 text-white">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="
                            M12 9v3.75
                            m9-.75a9 9 0 1 1-18 0
                            a9 9 0 0 1 18 0Z
                            m-9 3.75h.008v.008H12v-.008Z"/>
                </svg>
            </div>
        </div>

        <!-- Bulan Ini -->
        <div class="bg-gradient-to-r from-teal-500 to-emerald-200 text-white p-6 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold">Bulan Ini</h4>
                <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}</p>
            </div>
            
            <!-- ICON -->
            <div class="bg-white/20 p-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-9 h-9 text-white">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="
                            M2.25 18
                            L9 11.25
                            l4.306 4.306
                            a11.95 11.95 0 0 1 5.814-5.518
                            l2.74-1.22
                            m0 0-5.94-2.281
                            m5.94 2.28-2.28 5.941
                        " />
                </svg>
            </div>
        </div>
    </div>

        <!-- Grid bawah -->
        <div class="grid grid-cols-2 gap-8">
        <!-- Pembayaran Terbaru -->
        <div class="bg-gradient-to-br from-teal-50 to-emerald-50 border-2 border-teal-200 p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <!-- Header dengan Icon -->
            <div class="flex items-center gap-3 mb-3">
            <div class="bg-teal-500 p-2.5 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Pembayaran Terbaru</h3>
                <p class="text-xs text-gray-600">Transaksi pembayaran terkini</p>
            </div>
            </div>

            <div class="pembayaran-terbaru space-y-3 max-h-[400px] overflow-y-auto">
            @forelse($pembayaranTerbaru ?? collect() as $p)
                <div class="bg-white rounded-lg p-4 flex justify-between items-center border-2 border-gray-100 hover:border-teal-400 hover:shadow-md transition">
                <div class="flex-1">
                    <p class="font-bold text-gray-800 text-base">{{ $p->nama_santri ?? 'Nama Tidak Ada' }}</p>
                    <p class="text-sm text-gray-600 mt-1">
                    <span class="font-medium">Bulan:</span> {{ $p->bulan ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-500 font-semibold mt-0.5">
                    Tanggal Pembayaran : {{ \Carbon\Carbon::parse($p->tanggal_bayar)->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="text-right ml-4">
                    <p class="font-bold text-teal-600 text-lg">Rp {{ number_format($p->jumlah_bayar ?? 0, 0, ',', '.') }}</p>
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mt-1
                    {{ $p->status == 'lunas' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($p->status ?? '-') }}
                    </span>
                </div>
                </div>
            @empty
                <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                <p class="text-gray-400 italic">Belum ada data pembayaran</p>
                </div>
            @endforelse
            </div>
        </div>

        <!-- Santri Belum Bayar -->
        <div class="bg-gradient-to-br from-rose-50 to-red-50 border-2 border-rose-200 p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <!-- Header dengan Icon -->
            <div class="flex items-center gap-3 mb-3">
            <div class="bg-rose-500 p-2.5 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Santri Belum Bayar</h3>
                <p class="text-xs text-gray-600">Belum pernah melakukan pembayaran</p>
            </div>
            </div>

            <div class="santri-belum-bayar space-y-3 max-h-[400px] overflow-y-auto">
            @forelse($santriBelumBayar ?? collect() as $santri)
                <div class="bg-white rounded-lg p-4 flex justify-between items-center border-2 border-gray-100 hover:border-rose-400 hover:shadow-md transition">
                <div class="flex-1">
                    <p class="font-bold text-gray-800 text-base">{{ $santri->nama }}</p>
                    <p class="text-sm text-gray-600 mt-1">
                    <span class="font-medium">Wali:</span> {{ $santri->wali }}
                    </p>
                    <p class="text-xs text-gray-500 mt-0.5">
                    📞 {{ $santri->telepon }}
                    </p>
                </div>
                <div class="text-right ml-4">
                    <span class="inline-block px-3 py-1.5 text-xs font-semibold rounded-full bg-rose-100 text-rose-700">
                    Belum Bayar
                    </span>
                    <p class="text-xs text-gray-500 mt-1">Tidak ada riwayat</p>
                </div>
                </div>
            @empty
                <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-gray-400 italic">Semua santri sudah bayar! 🎉</p>
                </div>
            @endforelse
    </div>
  </div>
</div>
</div>

{{-- SCRIPT realtime AJAX polling --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const url = "{{ route('admin.dashboard.data') }}"; // pastikan blade di-parse (file .blade.php)
    const elTotal = document.querySelector('.total-santri');
    const elLunas = document.querySelector('.sudah-lunas');
    const elBelum = document.querySelector('.belum-bayar');
    const elBulan = document.querySelector('.bulan-ini');
    const elPembayaranList = document.querySelector('.pembayaran-terbaru');
    const elSantriBelum = document.querySelector('.santri-belum-bayar');

    async function updateDashboard() {
        try {
            const res = await fetch(url);
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();

            if (elTotal) elTotal.textContent = data.totalSantri ?? 0;
            if (elLunas) elLunas.textContent = data.sudahLunas ?? 0;
            if (elBelum) elBelum.textContent = data.belumBayar ?? 0;
            if (elBulan) elBulan.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(data.bulanIni ?? 0);

            // Pembayaran terbaru
            if (elPembayaranList) {
                elPembayaranList.innerHTML = '';
                (data.pembayaranTerbaru ?? []).forEach(p => {
                    const tanggal = new Date(p.tanggal_bayar);
                    const options = { day: 'numeric', month: 'long', year: 'numeric' };
                    const tanggalFormat = tanggal.toLocaleDateString('id-ID', options);
                    
                    elPembayaranList.insertAdjacentHTML('beforeend', `
                        <div class="bg-white rounded-lg p-4 flex justify-between items-center border-2 border-gray-100 hover:border-teal-400 hover:shadow-md transition">
                            <div class="flex-1">
                                <p class="font-bold text-gray-800 text-base">${p.nama_santri || 'Nama Tidak Ada'}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">Bulan:</span> ${p.bulan || '-'}
                                </p>
                                <p class="text-xs text-gray-500 font-semibold mt-0.5">
                                    Tanggal Pembayaran : ${tanggalFormat}
                                </p>
                            </div>
                            <div class="text-right ml-4">
                                <p class="font-bold text-teal-600 text-lg">Rp ${new Intl.NumberFormat('id-ID').format(p.jumlah_bayar || 0)}</p>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mt-1 ${p.status === 'lunas' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                                    ${p.status ? p.status.charAt(0).toUpperCase() + p.status.slice(1) : '-'}
                                </span>
                            </div>
                        </div>
                    `);
                });
                if ((data.pembayaranTerbaru ?? []).length === 0) {
                    elPembayaranList.innerHTML = `
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            <p class="text-gray-400 italic">Belum ada data pembayaran</p>
                        </div>
                    `;
                }
            }

            // Santri belum bayar
            if (elSantriBelum) {
                elSantriBelum.innerHTML = '';
                (data.santriBelumBayar ?? []).forEach(s => {
                    elSantriBelum.insertAdjacentHTML('beforeend', `
                        <div class="bg-white rounded-lg p-4 flex justify-between items-center border-2 border-gray-100 hover:border-rose-400 hover:shadow-md transition">
                            <div class="flex-1">
                                <p class="font-bold text-gray-800 text-base">${s.nama}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">Wali:</span> ${s.wali}
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    📞 ${s.telepon}
                                </p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="inline-block px-3 py-1.5 text-xs font-semibold rounded-full bg-rose-100 text-rose-700">
                                    Belum Bayar
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Tidak ada riwayat</p>
                            </div>
                        </div>
                    `);
                });
                if ((data.santriBelumBayar ?? []).length === 0) {
                    elSantriBelum.innerHTML = `
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-gray-400 italic">Semua santri sudah bayar! 🎉</p>
                        </div>
                    `;
                }
            }
        } catch (err) {
            console.error('Gagal update dashboard:', err);
        }
    }

    updateDashboard();
    setInterval(updateDashboard, 5000);
});
</script>

    <style>
        .card:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease;
        }
    </style>
@endsection