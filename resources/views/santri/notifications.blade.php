@extends('santri.layouts.santri')

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

    <p class="text-sm text-gray-500 mb-6">Sistem Informasi Pembayaran Majelis Ta'lim Al-Mujahidin</p>

    <div id="notificationList" 
          class="space-y-4 text-gray-800 transition-all duration-200 flex flex-col min-h-[60vh]">
        <p class="text-gray-400 text-sm flex items-center gap-2">Memuat notifikasi...</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications();
        // setInterval(fetchNotifications, 5000); // Opsional: Hapus atau komentari jika tidak perlu refresh otomatis
    });

    function fetchNotifications() {
        fetch("{{ route('santri.notifications.fetch') }}")
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
                
                if (data && data.length > 0) {
                    total = data.length;
                    
                    data.forEach(item => {
                        let bgColor = '';
                        let typeText = '';
                        let descriptionHTML = '';
                        let borderColor = '';
                        let time = timeAgo(item.created_at || item.updated_at);
                        let mainColor = '';

                        if (item.type === 'SELAMAT_DATANG') {
                            bgColor = 'bg-blue-100';
                            borderColor = 'border-blue-500';
                            mainColor = 'text-blue-800';
                            typeText = 'Selamat Datang!';
                            
                            descriptionHTML = `
                                <p class="text-sm text-gray-700 font-medium">
                                    ${item.pesan.replace(/\*\*(.*?)\*\*/g, '<span class="font-bold">$1</span>')}
                                </p>
                            `;
                        } else if (item.type === 'KONFIRMASI_BERHASIL') {
                            bgColor = 'bg-green-100';
                            borderColor = 'border-green-500';
                            mainColor = 'text-green-800';
                            typeText = `Pembayaran Berhasil Dikonfirmasi`; 
                            
                            // *** KOREKSI DI SINI: Tambahkan metode_bayar ke deskripsi ***
                            descriptionHTML = `
                                <p class="text-sm text-gray-700">
                                    Pembayaran SPP bulan **${item.bulan}** telah berhasil dikonfirmasi oleh admin.
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    Jumlah: **Rp ${parseInt(item.jumlah_bayar).toLocaleString('id-ID')}** | Metode: **${item.metode_bayar}**
                                </p>
                            `;
                        // ***************************************************************
                        
                        } else if (item.type === 'JATUH_TEMPO') {
                            bgColor = 'bg-yellow-100'; // Ganti dari merah ke kuning agar beda dengan Lewat Jatuh Tempo
                            borderColor = 'border-yellow-500';
                            mainColor = 'text-yellow-800';
                            typeText = `⚠️ Peringatan Jatuh Tempo SPP Bulan ${item.bulan}`;
                            
                            descriptionHTML = `
                                <p class="text-sm text-gray-700">
                                    Pembayaran SPP untuk bulan **${item.bulan}** akan jatuh tempo dalam **${item.hari_sisa} hari**. Harap segera melakukan pembayaran.
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    Jumlah : **Rp ${parseInt(item.jumlah_bayar).toLocaleString('id-ID')}** | Jatuh tempo : **${item.tanggal_jatuh_tempo}**
                                </p>
                            `;
                        } else if (item.type === 'LEWAT_JATUH_TEMPO') { // Notif terpenting, kasih warna tegas
                            bgColor = 'bg-red-100';
                            borderColor = 'border-red-600';
                            mainColor = 'text-red-800';
                            typeText = `❌ Tagihan Lewat Jatuh Tempo!`;
                            
                            descriptionHTML = `
                                <p class="text-sm text-gray-700 font-bold">
                                    Tagihan SPP bulan **${item.bulan}** sudah **terlambat ${item.hari_terlambat} hari**. Mohon segera lunasi pembayaran Anda.
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    Jumlah : **Rp ${parseInt(item.jumlah_bayar).toLocaleString('id-ID')}** | Jatuh tempo : **${item.tanggal_jatuh_tempo}**
                                </p>
                            `;
                        } else {
                            bgColor = 'bg-gray-100';
                            borderColor = 'border-gray-400';
                            mainColor = 'text-gray-800';
                            typeText = 'Notifikasi Lainnya';
                            descriptionHTML = `<p class="text-sm text-gray-700">${item.pesan || 'Anda memiliki notifikasi baru.'}</p>`;
                        }

                        container.innerHTML += `
                            <div class="p-4 rounded-lg border-l-4 ${borderColor} ${bgColor} hover:shadow-md transition">
                                <p class="font-medium ${mainColor} mb-1">${typeText}</p>
                                ${descriptionHTML.replace(/\*\*(.*?)\*\*/g, '<span class="font-bold">$1</span>')}
                                <p class="text-xs text-gray-500 mt-2">${time}</p>
                            </div>
                        `;
                    });
                }

                if (total === 0) {
                    container.innerHTML = `
                        <div class="flex flex-col items-center justify-center text-center text-gray-400 min-h-[40vh]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.5 2.5 0 0018 14.5h-1m0 0a3.5 3.5 0 01-7 0m7 0V9.5a3.5 3.5 0 10-7 0v5m4 3h18"/>
                            </svg>
                            <p class="text-sm font-medium">Belum ada notifikasi terbaru.</p>
                        </div>
                    `;
                }
            })
            .catch(err => {
                console.error('Gagal mengambil notifikasi:', err);
                const container = document.getElementById('notificationList');
                container.innerHTML = `<p class="text-red-500 text-sm p-4">Gagal memuat notifikasi. Coba muat ulang halaman.</p>`;
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