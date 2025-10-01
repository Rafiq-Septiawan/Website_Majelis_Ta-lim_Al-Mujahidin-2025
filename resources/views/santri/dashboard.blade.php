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
        <button onclick="toggleSidebar()" class="text-white text-3xl font-bold">&#9776;</button>

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

        <!-- Sidebar -->
        <div id="sidebar" 
            class="fixed top-0 left-0 h-full w-64 bg-[#2C3E50] text-white transform -translate-x-full transition-transform duration-300 z-50">
        <!-- Header -->
        <div class="px-6 pt-6 pb-10">
            <a href="#" class="flex items-center gap-3 mt-[10px]">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="size-10 text-primary" fill="none" viewBox="0 0 24 24" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                </svg>
                <span class="text-base font-medium">ADMIN</span>
            </a>
            <hr class="mt-2 border-gray-400/50">
        </div>

                    <!-- Menu -->
                    <nav class="mt-4">
                        <ul class="space-y-1">
                            <!-- Dashboard -->
                            <li>
                                <a href="{{ url('/admin/dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/>
                                    <rect width="7" height="9" x="14" y="12" rx="1"/>
                                    <rect width="7" height="5" x="3" y="16" rx="1"/>
                                    </svg>
                                    <span>DASHBOARD</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>

                            <!-- Profil -->
                            <li>
                                <a href="/profile"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <span>PROFIL</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>

                            <!-- Data Santri -->
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    <span>DATA SANTRI</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>

                            <!-- Input Pembayaran -->
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote-arrow-down-icon lucide-banknote-arrow-down"><path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5"/><path d="m16 19 3 3 3-3"/><path d="M18 12h.01"/>
                                    <path d="M19 16v6"/><path d="M6 12h.01"/><circle cx="12" cy="12" r="2"/>
                                    </svg>
                                    <span>INPUT PEMBAYARAN</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>

                            <!-- Laporan -->
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-minus-icon lucide-clipboard-minus"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M9 14h6"/>
                                    </svg>
                                    <span>LAPORAN</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>
                        </ul>
                    </nav>

             <!-- Tombol Logout -->
            <div class="absolute bottom-6 w-full px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="flex items-center gap-3 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 12H9m9 0-3-3m3 3-3 3" />
                        </svg>
                        <span class="font-semibold text-sm">KELUAR</span>
                    </button>
                </form>
                    <footer class="text-center text-zinc-400 text-xs mt-10 -mb-[10px]">
                        © 2025 | Majelis Ta’lim Al-Mujahidin
                    </footer>
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
