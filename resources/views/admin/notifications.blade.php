@extends('admin.layouts.admin')

@section('title', 'Notifikasi | Majelis Ta\'lim Al-Mujahidin')

@section('content')
<div class="min-h-[80vh] p-6 mt-[50px]">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold">NOTIFIKASI</h2>
        
        <button onclick="window.history.back()" 
                class="flex items-center bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
            Kembali
        </button>
    </div>

    <p class="text-sm text-gray-500 mb-6">Pemberitahuan Transaksi dan Pendaftaran Santri</p>

    <div id="notificationList" 
         class="space-y-4 text-gray-800 transition-all duration-200 flex flex-col min-h-[60vh]">
        <p class="text-gray-400 text-sm flex items-center gap-2">Memuat notifikasi...</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchNotifications();

    setInterval(fetchNotifications, 5000);
});

function fetchNotifications() {
    fetch("{{ route('admin.notifications.fetch') }}")
        .then(res => {
            if (!res.ok) {
                throw new Error('Gagal mengambil data dari server');
            }
            return res.json();
        })
        .then(data => {
            const container = document.getElementById('notificationList');
            container.innerHTML = '';
            let total = 0;

            if (data.pembayaran && data.pembayaran.length > 0) {
                total += data.pembayaran.length;
                data.pembayaran.forEach(item => {
                    let bgColor = 'bg-green-100';
                    let borderColor = 'border-green-500';
                    let mainColor = 'text-green-800';
                    let typeText = 'NOTIFIKASI TRANSAKSI';
                    let actionLink = '';
                
                    typeText = 'NOTIFIKASI PEMBAYARAN';
                    actionLink = `<a href="/admin/pembayaran/${item.id}" class="text-sm text-green-700 hover:text-green-900 transition mt-2 block">Lihat Detail</a>`;

                    container.innerHTML += `
                        <div class="p-4 rounded-lg border-l-4 ${borderColor} ${bgColor} hover:shadow-lg transition duration-200">
                            <p class="font-bold ${mainColor} mb-1">${typeText}</p>
                            <p class="text-sm text-gray-700">
                                Santri <span class="font-bold">${item.nama_santri}</span> telah melakukan pembayaran SPP bulan <span class="font-bold">${item.bulan}</span>.
                            </p>
                            <p class="text-xs text-gray-600 mt-1">
                                Jumlah: <span class="font-bold">Rp ${parseInt(item.jumlah_bayar).toLocaleString('id-ID')}</span> 
                                | Metode: <span class="font-semibold">${item.metode_bayar}</span>
                            </p>
                        </div>
                    `;
                });
            }

            if (data.santriBaru && data.santriBaru.length > 0) {
                total += data.santriBaru.length;
                data.santriBaru.forEach(s => {
                    container.innerHTML += `
                        <div class="bg-blue-100 p-4 rounded-lg border-l-4 border-blue-500 hover:shadow-lg transition duration-200">
                            <p class="font-bold text-blue-800">PENDAFTARAN SANTRI BARU</p>
                            <p class="text-sm text-gray-700">
                                Santri bernama <span class="font-bold">${s.name}</span> baru saja mendaftar dan membutuhkan verifikasi/pengaturan tagihan.
                            </p>
                            <p class="text-xs text-gray-500 mt-2">${timeAgo(s.created_at)}</p>
                        </div>
                    `;
                });
            }

            if (total === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center text-center text-gray-400 min-h-[40vh]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.5 2.5 0 0018 14.5h-1m0 0a3.5 3.5 0 01-7 0m7 0V9.5a3.5 3.5 0 10-7 0v5m-4 3h18"/>
                        </svg>
                        <p class="text-sm font-medium">Belum ada notifikasi terbaru yang perlu ditindaklanjuti.</p>
                    </div>
                `;
            }
        })
        .catch(err => {
            console.error('Gagal mengambil notifikasi:', err);
            const container = document.getElementById('notificationList');
            container.innerHTML = `<p class="text-red-500 text-sm p-4">Gagal memuat notifikasi. Coba muat ulang halaman atau periksa koneksi server.</p>`;
        });
}

function timeAgo(datetime) {
    const now = new Date();
    const then = new Date(datetime);
    const diff = Math.floor((now - then) / 1000);
    
    if (diff < 60) return 'Baru saja';
    if (diff < 3600) return `${Math.floor(diff / 60)} menit yang lalu`;
    if (diff < 86400) return `${Math.floor(diff / 3600)} jam yang lalu`;
    return `${Math.floor(diff / 86400)} hari yang lalu`;
}
</script>
@endsection