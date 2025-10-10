@extends('admin.layouts.admin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Santri | Majelis Ta’lim Al-Mujahidin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-primary">
    <!-- Navbar -->
    <div class="bg-primary px-4 py-2 flex items-center justify-between mx-14 mt-8 rounded-xl shadow-lg relative z-50 ">
        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-85 hidden z-40" onclick="toggleSidebar()"></div>

        <!-- Hamburger -->
        <button onclick="toggleSidebar()" class="text-white text-3xl font-bold">&#9776;</button>

        <!-- Search Bar -->
        <div class="flex items-left bg-white px-3 py-2 rounded-lg w-1/2">
            <input type="text" placeholder="Cari..." class="w-full outline-none text-gray-700">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            <a href="{{ route('admin.profile.index') }}" class="hover:text-gray-300">
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
        class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-[#2C3E50] to-[#34495E] 
        text-white transform -translate-x-full transition-all duration-300 ease-in-out z-50 shadow-2xl rounded-r-2xl">

        <!-- Header -->
        <div class="px-6 pt-6 pb-6 border-b border-white/10">
            <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 mt-[10px]">
            <!-- Foto Profil -->
            <img 
                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" 
                alt="Foto Profil" 
                class="w-12 h-12 rounded-full border-2 border-white object-cover shadow-md"
            />
            <div class="flex flex-col">
                <span class="text-sm text-gray-300">ADMIN</span>
                <span class="text-base font-semibold">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </a>
        </div>

        <!-- Menu -->
        <nav class="mt-4 px-2">
            <ul class="space-y-1">
                <li>
                    <a href="{{ url('/admin/dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <rect width="7" height="9" x="3" y="3" rx="1"/>
                            <rect width="7" height="5" x="14" y="3" rx="1"/>
                            <rect width="7" height="9" x="14" y="12" rx="1"/>
                            <rect width="7" height="5" x="3" y="16" rx="1"/>
                        </svg>
                        <span class="font-medium text-sm tracking-wider">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.profile.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20a7.5 7.5 0 0 1 15 0" />
                        </svg>
                        <span class="font-medium text-sm tracking-wider">Profil</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.santri.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6A2 2 0 0 1 18.45 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2A2 2 0 0 0 12.4 6H18a2 2 0 0 1 2 2v2"/>
                        </svg>
                        <span class="font-medium text-sm tracking-wider">Data Santri</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pembayaran.input') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5"/>
                            <path d="m16 19 3 3 3-3"/>
                            <circle cx="12" cy="12" r="2"/>
                        </svg>
                        <span class="font-medium text-sm tracking-wider">Input Pembayaran</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                            <path d="M9 14h6"/>
                        </svg>
                        <span class="font-medium text-sm tracking-wider">Laporan</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout -->
        <div class="mt-auto w-full px-4 pb-6 absolute bottom-0 left-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="flex items-center justify-center gap-2 px-2 py-2 w-full bg-red-600 hover:bg-red-700 rounded-md font-semibold text-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 12H9m9 0-3-3m3 3-3 3" />
                    </svg>
                    KELUAR
                </button>
            </form>

            <footer class="text-center text-gray-400 text-xs mt-4">
                © 2025 | Majelis Ta'lim Al-Mujahidin
            </footer>
        </div>
        </div>

        <!-- Script toggle -->
        <script>
        function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
        }
        </script>

    <!-- Container Utama -->
    <div class="bg-white rounded-2xl shadow-lg p-4 mx-6 relative z-40 -mb-[10px] -mt-[70px]">
        <div class="p-6 bg-white rounded-2xl flex-1 flex flex-col">

            <!-- Header + Tombol -->
            <div class="flex items-center justify-between mt-[60px] mb-2">
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
                    DATA SANTRI
                </h1>

                    <!-- Search Bar & Tombol Tambah -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                        <div class="relative flex items-center flex-1 max-w-sm">
                        <input 
                            type="text"  
                            id="searchInput"
                            placeholder="Cari santri..."
                            onkeyup="searchTable()"
                            class="w-full pl-9 pr-4 py-1.5 text-sm rounded-md border border-gray-200 
                                bg-gradient-to-r from-gray-50 to-white text-gray-700 
                                placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400/60 focus:border-teal-500
                                transition-all duration-200 ease-in-out shadow-sm focus:shadow-md
                                focus:translate-y-[-1px]">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="absolute left-2.5 h-4 w-4 text-gray-400 pointer-events-none transition-all duration-200" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                        <!-- Tombol Tambah -->
                        <a href="{{ route('admin.santri.create') }}"
                            class="flex items-center bg-primary hover:bg-teal-700 text-white text-sm font-medium 
                                px-4 py-1.5 rounded-md shadow-sm hover:shadow-md transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah
                        </a>
                        <!-- Tombol kembali -->
                        <button onclick="window.history.back()"
                            class="flex items-center bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                            Kembali
                        </button>
                    </div>
                </div>
            
            <!-- Tabel -->
            <div class="overflow-x-auto rounded-xl shadow-md mt-6">
                <table id="dataSantri"
                    class="min-w-full text-sm text-left border border-gray-200 rounded-lg">
                    <thead class="bg-primary text-white sticky top-0 z-10">
                        <tr>
                            <th class="px-2 py-2 text-center font-semibold">No</th>
                            <th class="px-2 py-2 text-center font-semibold">Nama Santri</th>
                            <th class="px-2 py-2 text-center font-semibold">Jenis Kelamin</th>
                            <th class="px-2 py-2 text-center font-semibold">Tanggal Lahir</th>
                            <th class="px-2 py-2 text-center font-semibold">Wali Santri</th>
                            <th class="px-2 py-2 text-center font-semibold">Alamat</th>
                            <th class="px-2 py-2 text-center font-semibold">No. Telepon</th>
                            <th class="px-2 py-2 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($santris as $no => $s)
                        <tr class="hover:bg-gray-50 even:bg-gray-50/40 border-b border-gray-200">
                            <td class="px-2 py-1 text-center text-gray-700 font-medium">{{ $no+1 }}</td>
                            <td class="px-2 py-1 text-gray-800 font-semibold">{{ $s->nama }}</td>
                            <td class="px-2 py-1 text-center">{{ $s->jenis_kelamin }}</td>
                            <td class="px-2 py-1 text-gray-600">{{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d/m/Y') }}</td>
                            <td class="px-2 py-1 text-gray-700">{{ $s->wali }}</td>
                            <td class="px-2 py-1 text-gray-700">{{ $s->alamat }}</td>
                            <td class="px-2 py-1 text-gray-700">{{ $s->telepon }}</td>

                            <!-- Tombol Aksi -->
                            <td class="px-1 py-1 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.santri.edit', $s->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs flex items-center gap-1 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 
                                                0 112.652 2.652L10.582 16.07a4.5 4.5 0 
                                                01-1.897 1.13L6 18l.8-2.685a4.5 4.5 
                                                0 011.13-1.897l8.932-8.931z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button"
                                        class="btn-hapus bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs flex items-center gap-1 transition btn-hapus"
                                        data-id="{{ $s->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 
                                                    9m9.968-3.21c.342.052.682.107 
                                                    1.022.166m-1.022-.165L18.16 
                                                    19.673a2.25 2.25 0 01-2.244 
                                                    2.077H8.084a2.25 2.25 0 
                                                    01-2.244-2.077L4.772 
                                                    5.79m14.456 0a48.108 48.108 
                                                    0 00-3.478-.397m-12 
                                                    .562c.34-.059.68-.114 
                                                    1.022-.165m0 0a48.11 48.11 
                                                    0 013.478-.397m7.5 
                                                    0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 
                                                    51.964 0 00-3.32 
                                                    0c-1.18.037-2.09 
                                                    1.022-2.09 2.201v.916m7.5 
                                                    0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500 italic">Belum ada yang ditambahkan!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            <!-- Pagination -->
            @if ($santris->hasPages())
                <div class="mt-4 mb-4 flex justify-end pr-6">
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center space-x-2">
                        {{-- Tombol Previous --}}
                        @if ($santris->onFirstPage())
                            <span class="px-3 py-1.5 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm shadow-sm">
                                ‹
                            </span>
                        @else
                            <a href="{{ $santris->previousPageUrl() }}" 
                            class="px-3 py-1.5 bg-white border border-gray-200 text-gray-700 hover:bg-teal-500 hover:text-white rounded-lg text-sm shadow-sm transition">
                                ‹
                            </a>
                            @endif

                            {{-- Nomor Halaman --}}
                            @foreach ($santris->getUrlRange(1, $santris->lastPage()) as $page => $url)
                                @if ($page == $santris->currentPage())
                                    <span class="px-3 py-1.5 bg-primary text-white rounded-lg text-sm shadow-md font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                    class="px-3 py-1.5 bg-white border border-gray-200 text-gray-700 hover:bg-teal-500 hover:text-white rounded-lg text-sm shadow-sm transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Tombol Next --}}
                            @if ($santris->hasMorePages())
                                <a href="{{ $santris->nextPageUrl() }}" 
                                class="px-3 py-1.5 bg-white border border-gray-200 text-gray-700 hover:bg-teal-500 hover:text-white rounded-lg text-sm shadow-sm transition">
                                    ›
                                </a>
                            @else
                                <span class="px-3 py-1.5 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm shadow-sm">
                                    ›
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        </div>
        <footer class="text-zinc-400 text-xs ml-4 mt-[px] mb-[10px]">© 2025 | Majelis Ta’lim Al-Mujahidin</footer>
    </div>

    <!-- Script pencarian -->
    <script>
    function searchTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("dataSantri");
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // mulai dari 1 biar skip header
            const row = tr[i];
            const text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }
    </script>

    <!-- Script SweetAlert2 untuk konfirmasi hapus -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".btn-hapus");

    buttons.forEach(btn => {
        btn.addEventListener("click", function() {
            const santriId = this.getAttribute("data-id");

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data santri akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Kirim request DELETE via AJAX
                    fetch(`{{ route('admin.santri.destroy', '') }}/${santriId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-HTTP-Method-Override': 'DELETE',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const err = await response.text();
                            throw new Error(err);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            btn.closest('tr').remove();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: data.message || 'Gagal menghapus data.',
                                icon: 'error'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error'
                        });
                    });
                }
                });
            });
        });
    });
    </script>

    <style>
        tr { transition: background-color 0.2s ease; }
        tr:hover td { background-color: #e7e7e7; }
        button svg, a svg { transition: transform 0.2s ease; }
        button:hover svg, a:hover svg { transform: scale(1.1); }
        td, th { border-right: 1px solid #e5e7eb; }
        td:last-child, th:last-child { border-right: none; }
    </style>

</body>
</html>
