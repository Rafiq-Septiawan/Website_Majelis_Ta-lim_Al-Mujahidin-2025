@include('admin.layouts.navigation')

<nav class="bg-primary text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 11c0-1.1.9-2 2-2s2 .9 2 2v8h-4v-8zM6 11c0-1.1.9-2 2-2s2 .9 2 2v8H6v-8zM3 20h18M4 4h16M4 8h16" />
                    </svg>
                    <span class="font-bold">Majelis Ta'lim</span>
                </a>
            </div>

            <div class="hidden sm:flex space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('santri.index') }}" class="hover:underline">Data Santri</a>
                <a href="#" class="hover:underline">Pembayaran</a>
                <a href="#" class="hover:underline">Laporan</a>
            </div>

            <div class="hidden sm:flex space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                @endguest

                @auth
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @endauth
            </div>

            <div class="sm:hidden">
                <button id="menu-btn" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden sm:hidden bg-primary text-white px-4 pb-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>
        <a href="{{ route('santri.index') }}" class="block">Data Santri</a>
        <a href="#" class="block">Pembayaran</a>
        <a href="#" class="block">Laporan</a>

        @guest
            <a href="{{ route('login') }}" class="block">Login</a>
            <a href="{{ route('register') }}" class="block">Register</a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<script>
    document.getElementById("menu-btn").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    });
</script>
