<div id="sidebar"
    class="fixed top-0 left-0 h-full w-64
    bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900
    text-gray-100 transform -translate-x-full transition-all duration-300 ease-in-out
    z-50 flex flex-col shadow-2xl
    border-none backdrop-blur-md
    rounded-r-3xl overflow-hidden">

    <!-- Header Profile -->
    <div class="px-5 pt-6 pb-5 bg-gradient-to-br from-emerald-600/20 to-teal-600/10 border-b border-emerald-500/30">
        <a href="{{ route('santri.profile.index') }}" class="flex items-center gap-3 group">
            <div class="relative">
                <img 
                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" 
                    alt="Foto Profil" 
                    class="w-12 h-12 rounded-full border-2 border-emerald-400 object-cover shadow-lg group-hover:scale-110 transition-transform duration-300"
                />
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 rounded-full border-2 border-slate-900 animate-pulse"></span>
            </div>
            <div class="flex-1">
                <p class="text-[10px] text-emerald-400 font-bold tracking-wider">SANTRI</p>
                <p class="text-sm font-bold text-white group-hover:text-emerald-300 transition-colors truncate">
                    {{ Auth::user()->name ?? 'Santri' }}
                </p>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-2 scrollbar-thin scrollbar-thumb-emerald-600 scrollbar-track-slate-800">
        <ul class="space-y-0">
            <!-- DASHBOARD -->
            <li>
                <a href="{{ route('santri.dashboard') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('santri/dashboard*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    <!-- Active Indicator -->
                    @if(Request::is('santri/dashboard*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('santri/dashboard*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                <a href="{{ route('santri.profile.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('santri/profile*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('santri/profile*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('santri/profile*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20a7.5 7.5 0 0 1 15 0" />
                    </svg>
                    <span class="tracking-wide">PROFIL</span>
                </a>
            </li>

            <!-- PEMBAYARAN -->
            <li>
                <a href="{{ route('santri.pembayaran.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('santri/pembayaran*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('santri/pembayaran*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('santri/pembayaran*') ? 'text-white' : 'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    <span class="tracking-wide">PEMBAYARAN</span>
                </a>
            </li>

            <!-- KWITANSI -->
            <li>
                <a href="{{ route('santri.kwitansi.index') }}"
                    class="flex items-center gap-3 px-5 py-3.5 font-bold text-[15px] transition-all duration-200 group relative
                    {{ Request::is('santri/kwitansi*') 
                        ? 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-600/50' 
                        : 'text-gray-300 hover:bg-gradient-to-r hover:from-emerald-600/20 hover:to-teal-600/10 hover:text-emerald-300' }}">
                    
                    @if(Request::is('santri/kwitansi*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-300"></span>
                    @endif
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('santri/kwitansi*') ? 'text-white' :  'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span class="tracking-wide">KWITANSI</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer Section -->
    <div class="border-t border-slate-700 bg-slate-900/50">
        <!-- Logout Button -->
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