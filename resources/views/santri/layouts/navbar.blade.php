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
    <div class="relative flex items-left left-[40px] bg-white px-3 py-2 rounded-lg w-1/2">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Cari..." 
            class="w-full outline-none text-gray-700"
            onkeyup="filterResults()"
        >
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
            <a href="{{ route('santri.notifications.index') }}" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" 
                    fill="currentColor" 
                    class="size-9">
                    <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 
                            9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248
                            A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1
                            8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248
                            A9.72 9.72 0 0 0 19.266 2.5Z" />
                    <path fill-rule="evenodd" 
                        d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75
                            a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206
                            c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0
                            24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205
                            8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18
                            c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1
                            a2.25 2.25 0 1 1-4.5 0Z" 
                        clip-rule="evenodd" />
                </svg>
        </a>

        <!-- User -->
                <a href="{{ route('santri.profile.index') }}" class="hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
                        fill="currentColor" class="size-9">
                        <path fill-rule="evenodd" 
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" 
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

