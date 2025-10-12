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
