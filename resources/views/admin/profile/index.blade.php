@extends('admin.layouts.admin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL ADMIN</title>
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
                                <a href="{{ route('admin.profile.index') }}"
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
                                <a href="{{ route('admin.santri.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-white hover:text-[#2C3E50] transition rounded-md uppercase font-semibold text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    <span>DATA SANTRI</span>
                                </a>
                                <hr class="border-gray-400/50">
                            </li>

                            <!-- Input Pembayaran -->
                            <li>
                                <a href="{{ route('admin.pembayaran.input') }}"
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
                                <a href="{{ route('admin.laporan') }}"
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
<div class="bg-white rounded-2xl shadow-lg p-4 mx-6 relative z-40 -mt-[70px] min-h-screen flex flex-col">
    <!-- Konten -->
    <div class="p-6 bg-white rounded-2xl flex-1 flex flex-col">
        
        <!-- Header + Search + Tombol -->
        <div class="flex items-center justify-between mt-[65px] mb-4">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                     class="size-9">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M18 18.72a9.094 9.094 0 0 0 3.741-.479
                             3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0
                             .225-.012.447-.037.666A11.944 11.944 0 0 1 
                             12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 
                             6.062 0 0 1 6 18.719m12 0a5.971 5.971 
                             0 0 0-.941-3.197m0 0A5.995 5.995 
                             0 0 0 12 12.75a5.995 5.995 0 0 
                             0-5.058 2.772m0 0a3 3 0 0 
                             0-4.681 2.72 8.986 8.986 0 0 
                             0 3.74.477m.94-3.197a5.971 
                             5.971 0 0 0-.94 3.197M15 
                             6.75a3 3 0 1 1-6 0 3 3 
                             0 0 1 6 0Zm6 3a2.25 2.25 
                             0 1 1-4.5 0 2.25 2.25 
                             0 0 1 4.5 0Zm-13.5 0a2.25 
                             2.25 0 1 1-4.5 0 2.25 
                             2.25 0 0 1 4.5 0Z" />
                </svg>
                PROFIL PENGGUNA
            </h1>

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
