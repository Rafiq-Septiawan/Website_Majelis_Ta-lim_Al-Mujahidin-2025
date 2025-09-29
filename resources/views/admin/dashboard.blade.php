<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-primary">
        <!-- Navbar -->
      <div class="bg-primary px-4 py-2 flex items-center justify-between 
              mx-14 mt-8 rounded-xl shadow-lg relative z-50 ">

        <!-- Overlay -->
        <div id="overlay" 
            class="fixed inset-0 bg-black bg-opacity-85 hidden z-40" 
            onclick="toggleSidebar()">
        </div>

        <!-- Hamburger -->
        <button onclick="toggleSidebar()" class="text-white text-3xl font-bold">&#9776;</button>

        <!-- Search Bar -->
        <div class="flex items-left bg-white px-3 py-2 rounded-lg w-1/2">
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
                <path fill-rule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clip-rule="evenodd" />
                </svg>

            </button>

            <!-- User -->
                <a href="/profile" class="hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
                        fill="currentColor" class="size-9">
                        <path fill-rule="evenodd" 
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" 
                            clip-rule="evenodd" />
                    </svg>
                </a>
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
                    <a href="{{ route('santri.index') }}"
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


  <!-- Container Putih Utama -->
  <div class="bg-white rounded-2xl shadow-lg p-4 mx-6 relative z-40 -mb-[20px]  mb-[20px] -mt-[80px]">
      <h1 class="font-bold text-xl text-stone-950 ml-[20px] mb-[10px] mt-[90px]">Selamat Datang, Admin</h1>
    <!-- Konten -->
    <div class="p-4 bg-white rounded-2xl p-2">
        <!-- Statistik -->
        <div class="grid grid-cols-4 gap-8 mb-6">
            <!-- Total Santri -->
            <div class="bg-zinc-300 rounded-lg p-4 text-center">
                <div class="flex justify-center mb-2">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                    <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>
                </div>
                <p class="text-sm">Total Santri</p>
                <h2 class="text-xl font-bold">35</h2>
            </div>

            <!-- Lunas -->
            <div class="bg-zinc-300 rounded-lg p-4 text-center">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                    <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm">Lunas</p>
                <h2 class="text-xl font-bold">20</h2>
            </div>

            <!-- Belum Bayar -->
            <div class="bg-zinc-300 rounded-lg p-4 text-center">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm">Belum Bayar</p>
                <h2 class="text-xl font-bold">15</h2>
            </div>

            <!-- Bulan Ini -->
            <div class="bg-zinc-300 rounded-lg p-4 text-center">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                    <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm">Bulan Ini</p>
                <h2 class="text-xl font-bold">Rp 1.000.000</h2>
            </div>
        </div>

        <!-- Grid bawah -->
        <div class="grid grid-cols-2 gap-8">

            <!-- KOTAK PEMBAYARAN TERBARU -->
            <div class="bg-zinc-300 p-6 rounded-lg">
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                            <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                            <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                            <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                        </svg>
                        <h3 class="font-bold text-xl">Pembayaran Terbaru</h3>
                    </div>
                    <p class="text-1xs text-gray-600 mb-3">Transaksi pembayaran terkini dari santri</p>
              
            <!-- list 1 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Anggun</p>
                        <p class="text-sm text-gray-500">SPP - 2024-01-15</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-green-600">Lunas</p>
                    </div>
                    </li>
                </div>

            <!-- list 2 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Arka</p>
                        <p class="text-sm text-gray-500">SPP - 2024-02-24</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-green-600">Lunas</p>
                    </div>
                    </li>
                </div>

            <!-- list 3 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Arsyia</p>
                        <p class="text-sm text-gray-500">SPP - 2024-04-20</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-green-600">Lunas</p>
                    </div>
                    </li>
                </div>

            <!-- list 4 -->
                <div class="bg-white p-3 rounded-lg">
                   <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Chandra</p>
                        <p class="text-sm text-gray-500">SPP - 2024-05-10</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-green-600">Lunas</p>
                    </div>
                    </li>
                </div>
            </div>

            <!-- KOTAK SANTRI BELUM BAYAR -->
             <div class="bg-zinc-300 p-6 rounded-lg">
                <div class="flex items-center gap-2 mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-bold text-xl">Santri Belum Bayar</h3>
                </div>
                    <p class="text-1xs text-gray-600 mb-3">Daftar santri yang belum melunasi pembayaran</p>
                
            <!-- list 1 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Azzam</p>
                        <p class="text-sm text-gray-500">SPP - 2024-01-15</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-rose-700">5 Hari</p>
                    </div>
                    </li>
                </div>

            <!-- list 2 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Mishall</p>
                        <p class="text-sm text-gray-500">SPP - 2024-02-24</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-rose-700">7 Hari</p>
                    </div>
                    </li>
                </div>

            <!-- list 3 -->
                <div class="bg-white p-3 rounded-lg mb-4">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Asha</p>
                        <p class="text-sm text-gray-500">SPP - 2024-04-20</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-rose-700">10 Hari</p>
                    </div>
                    </li>
                </div>

            <!-- list 4 -->
                <div class="bg-white p-3 rounded-lg">
                    <li class="flex justify-between">
                    <div>
                        <p class="font-semibold">Alvino</p>
                        <p class="text-sm text-gray-500">SPP - 2024-05-10</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp 50.000</p>
                        <p class="text-sm text-rose-700">15 Hari</p>
                    </div>
                    </li>
                </div>
            </div>
        <footer class="text-zinc-400">© 2025 | Majelis Ta’lim Al-Mujahidin</footer>
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

</body>
</html>
