<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Santri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary">

    <!-- Navbar -->
    <div class="bg-primary px-4 py-3 flex items-center justify-between">
        <!-- Left: Hamburger -->
        <button class="text-white text-2xl font-bold">&#9776;</button>

        <!-- Middle: Search Bar -->
        <div class="flex items-center bg-white px-3 py-2 rounded-lg w-1/2">
            <input type="text" placeholder="Cari..." class="w-full outline-none text-gray-700">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <!-- Right: Icons -->
        <div class="flex items-center space-x-4 text-white">
            <!-- Notifikasi -->
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967...Z" />
                </svg>
            </button>

            <!-- User -->
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488...Z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Konten -->
    <div class="p-6 bg-primary">
        <h1 class="font-bold text-2xl text-gray-50 mb-4">Dashboard Wali Santri</h1>
        <p class="text-gray-200 mb-6">Kelola pembayaran dan lihat riwayat transaksi</p>

        <!-- Statistik -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <!-- Total Dibayar -->
            <div class="bg-gray-200 rounded-lg p-4 flex flex-col justify-between">
                <p class="text-sm font-medium">Total Dibayar</p>
                <h2 class="text-xl font-bold text-green-700">Rp 1.000.000</h2>
                <span class="text-xs text-gray-600">2 Pembayaran</span>
            </div>

            <!-- Belum Bayar -->
            <div class="bg-gray-200 rounded-lg p-4 flex flex-col justify-between">
                <p class="text-sm font-medium">Belum Bayar</p>
                <h2 class="text-xl font-bold text-red-600">Rp 2.000.000</h2>
                <span class="text-xs text-gray-600">2 Tagihan</span>
            </div>

            <!-- Tombol Pembayaran -->
            <div class="bg-gray-200 rounded-lg p-4 flex flex-col justify-center items-center">
                <p class="text-sm font-medium">Pembayaran</p>
                <button class="bg-teal-500 text-white px-6 py-2 mt-2 rounded-lg font-semibold hover:bg-teal-600">
                    Bayar
                </button>
            </div>
        </div>

        <!-- Riwayat Pembayaran -->
        <div class="bg-gray-200 rounded-lg p-6">
            <h3 class="font-semibold mb-6">Riwayat Pembayaran</h3>
            <ul class="space-y-4 text-sm">
                <li class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Januari 2025</p>
                        <p class="text-xs text-gray-600">Jatuh tempo: 10/01/2025</p>
                        <p class="text-xs text-gray-600">Dibayar: 8/1/2024 via Transfer Bank</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <span class="text-green-600 font-medium">Lunas</span>
                    </div>
                </li>

                <li class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Februari 2025</p>
                        <p class="text-xs text-gray-600">Jatuh tempo: 12/02/2025</p>
                        <p class="text-xs text-gray-600">Dibayar: 12/2/2025 via Cash</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <span class="text-green-600 font-medium">Lunas</span>
                    </div>
                </li>

                <li class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">April 2025</p>
                        <p class="text-xs text-gray-600">Jatuh tempo: 10/04/2025</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <span class="text-orange-600 font-medium">Menunggu</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center text-sm text-neutral-900 bg-primary py-4">
        © 2025 | Majelis Ta’lim Al-Mujahidin
    </div>

</body>
</html>
