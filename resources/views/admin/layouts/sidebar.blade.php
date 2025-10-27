<div id="sidebar"
    class="fixed top-0 left-0 h-full w-64
    bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900
    text-gray-100 transform -translate-x-full transition-all duration-300 ease-in-out
    z-50 flex flex-col shadow-2xl
    border-none backdrop-blur-md
    rounded-r-3xl overflow-hidden">

    <!-- Header Profile -->
    <div class="px-5 pt-6 pb-5 bg-gradient-to-br from-emerald-600/20 to-teal-600/10 border-b border-emerald-500/30">
        <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 group">
            <div class="relative">
                <img 
                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" 
                    alt="Foto Profil" 
                    class="w-12 h-12 rounded-full border-2 border-emerald-400 object-cover shadow-lg group-hover:scale-110 transition-transform duration-300"
                />
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 rounded-full border-2 border-slate-900 animate-pulse"></span>
            </div>
            <div class="flex-1">
                <p class="text-[10px] text-emerald-400 font-bold tracking-wider">ADMINISTRATOR</p>
                <p class="text-sm font-bold text-white group-hover:text-emerald-300 transition-colors truncate">
                    {{ Auth::user()->name ?? 'Admin' }}
                </p>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-2 scrollbar-thin scrollbar-thumb-emerald-600 scrollbar-track-slate-800">
        <ul class="space-y-0">
            <!-- DASHBOARD -->
            <li>
                <a href="{{ url('/admin/dashboard') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('admin/dashboard*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
 
                    @if(Request::is('admin/dashboard*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('admin/dashboard*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect width="7" height="9" x="3" y="3" rx="1"/>
                        <rect width="7" height="5" x="14" y="3" rx="1"/>
                        <rect width="7" height="9" x="14" y="12" rx="1"/>
                        <rect width="7" height="5" x="3" y="16" rx="1"/>
                    </svg>
                    <span class="tracking-wide">DASHBOARD</span>
                </a>
            </li>

            <!-- PROFIL -->
            <li>
                <a href="{{ route('admin.profile.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('admin/profile*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('admin/profile*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('admin/profile*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20a7.5 7.5 0 0 1 15 0" />
                    </svg>
                    <span class="tracking-wide">PROFIL</span>
                </a>
            </li>

            <!-- DATA SANTRI -->
            <li>
                <a href="{{ route('admin.santri.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('admin/santri*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('admin/santri*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('admin/santri*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6A2 2 0 0 1 18.45 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2A2 2 0 0 0 12.4 6H18a2 2 0 0 1 2 2v2"/>
                    </svg>
                    <span class="tracking-wide">DATA SANTRI</span>
                </a>
            </li>

            <!-- INPUT PEMBAYARAN -->
            <li>
                <a href="{{ route('admin.pembayaran.input') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('admin/pembayaran*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('admin/pembayaran*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('admin/pembayaran*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5"/>
                        <path d="m16 19 3 3 3-3"/>
                        <circle cx="12" cy="12" r="2"/>
                    </svg>
                    <span class="tracking-wide">INPUT PEMBAYARAN</span>
                </a>
            </li>

            <!-- LAPORAN KEUANGAN-->
            <li>
                <a href="{{ route('admin.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('admin/laporan*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('admin/laporan*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('admin/laporan*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                        <path d="M9 14h6"/>
                    </svg>
                    <span class="tracking-wide">LAPORAN KEUANGAN</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="border-t border-slate-700 bg-slate-900/50">
        <div class="px-4 py-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="flex items-center justify-center gap-2.5 w-full py-3 
                    bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600
                    rounded-lg font-bold text-sm tracking-wide text-white
                    transition-all duration-300 shadow-lg shadow-red-600/30 hover:shadow-red-600/50
                    hover:scale-[1.02] active:scale-95 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 12H9m9 0-3-3m3 3-3 3" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
        <footer>
        <p class="text-xs text-teal-50 font-reguler text-center mt-4 mb-4">
                    © {{ date('Y') }} Majelis Ta'lim Al-Mujahidin
        </p>
    </footer>
    </div>
</div>

<style>
.scrollbar-thin::-webkit-scrollbar {
    width: 4px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #1e293b;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #059669;
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #10b981;
}
</style>