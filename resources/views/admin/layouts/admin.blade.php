<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Stack untuk styles dari halaman child --}}
    @stack('styles')
</head>

<body class="bg-primary min-h-screen">
    {{-- Navbar dan Sidebar --}}
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    <!-- Overlay -->
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"
        onclick="toggleSidebar()"></div>

    <!-- Konten utama -->
    <main class="bg-white rounded-2xl shadow-lg mx-6 mt-[-70px] -mb-[25px] p-6 relative z-40
        @yield('scroll', 'overflow-y-auto')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-teal-700 via-teal-600 to-emerald-600 text-white py-12 mt-12 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/3 translate-y-1/3"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">
                <div class="flex flex-col items-center md:items-start">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white/20 p-2.5 rounded-lg backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold">Majelis Ta'lim<br>Al-Mujahidin</h2>
                    </div>
                    <p class="text-sm text-teal-50 leading-relaxed max-w-xs">
                        Website sistem informasi administrasi dan pembayaran santri. Menghadirkan kemudahan bagi pengurus dan wali santri.
                    </p>
                </div>

                <div class="flex flex-col items-center md:items-start">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold">Kontak Kami</h2>
                    </div>
                    <ul class="text-sm text-teal-50 space-y-2.5">
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mt-0.5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Jl. Irigasi Sipon, Cipondoh Makmur</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span>089502704706</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span>almujahidin@yahoo.or.id</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col items-center md:items-start">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold">Ikuti Kami</h2>
                    </div>
                    <p class="text-sm text-teal-50 mb-4">Tetap terhubung dengan kami melalui media sosial</p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/rafiq.sptiawan/" target="_blank" 
                        class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg transition transform hover:scale-110 hover:-translate-y-1 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1 .9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2v2h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12" />
                            </svg>
                        </a>

                        <a href="https://www.instagram.com/majlis_talim_almujahidin?igsh=MTZzNTFqM3RkM2YzZw==" target="_blank" 
                        class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg transition transform hover:scale-110 hover:-translate-y-1 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.5-.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                        </a>

                        <a href="https://wa.me/6289502704706" target="_blank" 
                        class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg transition transform hover:scale-110 hover:-translate-y-1 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M12.003 2C6.478 2 2 6.477 2 12c0 1.858.506 3.602 1.389 5.102L2 22l5.016-1.363A9.951 9.951 0 0 0 12.003 22C17.528 22 22 17.523 22 12S17.528 2 12.003 2zm0 18a7.945 7.945 0 0 1-4.065-1.108l-.29-.172-2.978.809.819-2.909-.188-.298A7.933 7.933 0 0 1 4 12a8.001 8.001 0 1 1 8.003 8zM8.29 7.636l-.478-.01c-.15 0-.388.055-.592.277-.204.223-.78.762-.78 1.858s.799 2.152.91 2.3c.112.149 1.54 2.458 3.797 3.345 1.875.736 2.254.589 2.66.553.406-.037 1.31-.535 1.495-1.05.185-.516.185-.958.13-1.05-.056-.093-.204-.149-.426-.261-.222-.111-1.31-.64-1.512-.712-.202-.074-.351-.112-.498.111-.149.223-.574.712-.704.859-.13.148-.26.166-.482.056-.222-.111-.937-.346-1.785-1.104-.66-.586-1.105-1.308-1.235-1.531-.13-.222-.014-.342.098-.453.1-.1.223-.26.334-.389.112-.13.149-.223.223-.371.074-.148.037-.278-.018-.39-.056-.111-.498-1.203-.681-1.648z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/30 mt-10 -mb-[20px] pt-6 text-center">
                <p class="text-sm text-teal-50 font-medium">
                    © {{ date('Y') }} Majelis Ta'lim Al-Mujahidin — All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Script Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
    @stack('scripts')
</body>
</html>