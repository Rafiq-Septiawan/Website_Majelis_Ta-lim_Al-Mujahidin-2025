@extends('admin.layouts.admin')

@section('title', 'Notifikasi | Majelis Ta’lim Al-Mujahidin')

@section('content')

    <!-- Konten -->
    <div class="p-6 bg-white rounded-2xl flex-1 flex flex-col">
        
    <!-- HEADER -->
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Notifikasi</h2>
      <p class="text-gray-500">Informasi terbaru dari aktivitas santri dan pembayaran.</p>
    </div>

    <!-- KARTU STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-5 rounded-xl shadow-md">
        <h3 class="text-gray-500 text-sm mb-2">Total Santri</h3>
        <p class="text-3xl font-bold text-green-700">120</p>
        <span class="text-xs text-gray-400">2 santri baru minggu ini</span>
      </div>

      <div class="bg-white p-5 rounded-xl shadow-md">
        <h3 class="text-gray-500 text-sm mb-2">Pembayaran Selesai</h3>
        <p class="text-3xl font-bold text-green-700">86</p>
        <span class="text-xs text-gray-400">+5 hari ini</span>
      </div>

      <div class="bg-white p-5 rounded-xl shadow-md">
        <h3 class="text-gray-500 text-sm mb-2">Menunggu Konfirmasi</h3>
        <p class="text-3xl font-bold text-green-700">12</p>
        <span class="text-xs text-gray-400">Butuh pengecekan</span>
      </div>

      <div class="bg-white p-5 rounded-xl shadow-md">
        <h3 class="text-gray-500 text-sm mb-2">Notifikasi Baru</h3>
        <p class="text-3xl font-bold text-green-700">4</p>
        <span class="text-xs text-gray-400">Diterima 1 jam lalu</span>
      </div>
    </div>

    <!-- DAFTAR NOTIFIKASI -->
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Notifikasi</h3>
      <ul class="divide-y divide-gray-200">
        <li class="py-3 flex justify-between">
          <div>
            <p class="font-medium text-gray-800">Santri <span class="text-green-700">Ahmad Fauzi</span> telah melakukan pembayaran.</p>
            <p class="text-sm text-gray-500">5 menit yang lalu</p>
          </div>
          <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Pembayaran</span>
        </li>

        <li class="py-3 flex justify-between">
          <div>
            <p class="font-medium text-gray-800">Santri <span class="text-green-700">Siti Rahma</span> telah mengunggah bukti pembayaran.</p>
            <p class="text-sm text-gray-500">1 jam yang lalu</p>
          </div>
          <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">Menunggu</span>
        </li>

        <li class="py-3 flex justify-between">
          <div>
            <p class="font-medium text-gray-800">Santri <span class="text-green-700">Rizky Ananda</span> belum melakukan pembayaran bulan ini.</p>
            <p class="text-sm text-gray-500">Kemarin</p>
          </div>
          <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">Tertunda</span>
        </li>
      </ul>
    </div>
  </div>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleSidebar()"></div>

<script>
    function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    sidebar.classList.toggle("-translate-x-full");
    overlay.classList.toggle("hidden");}
</script>

@endsection