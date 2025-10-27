<div class="bg-primary px-4 py-2 flex items-center justify-between 
              mx-14 mt-8 rounded-xl shadow-lg relative z-50">

    <div id="overlay" 
        class="fixed inset-0 bg-black bg-opacity-85 hidden z-40" 
        onclick="toggleSidebar()">
    </div>

    <button onclick="toggleSidebar()" class="text-white text-3xl font-bold">&#9776;</button>

    <div class="relative left-[40px] w-1/2">
        <div class="flex items-center bg-white px-3 py-2 rounded-lg">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Cari..." 
                class="w-full outline-none text-gray-700"
                onkeyup="filterResults()"
                onfocus="filterResults()">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <div id="searchResults" 
            class="absolute top-full mt-2 w-full bg-white rounded-lg shadow-xl hidden z-50 max-h-96 overflow-y-auto">
        </div>
    </div>

    <div class="flex items-center space-x-4 text-white">     
        <a href="{{ route('admin.notifications') }}" class="relative hover:text-gray-300">
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

<script>
    const pages = [
        { 
            name: "Dashboard", 
            url: "{{ route('santri.dashboard') }}", 
            category: "Dashboard", 
            icon: `
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-5 h-5 {{ Request::is('santri/dashboard*') ? 'text-white' : 'text-emerald-400' }} 
                    group-hover:scale-110 transition-transform" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect width="7" height="9" x="3" y="3" rx="1"/>
                    <rect width="7" height="5" x="14" y="3" rx="1"/>
                    <rect width="7" height="9" x="14" y="12" rx="1"/>
                    <rect width="7" height="5" x="3" y="16" rx="1"/>
                </svg>
            `
        },
        { 
            name: "Profil", 
            url: "{{ route('santri.profile.index') }}", 
            category: "Profil", 
            icon: `
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-5 h-5 {{ Request::is('santri/profile*') ? 'text-white' : 'text-emerald-400' }} 
                    group-hover:scale-110 transition-transform" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20a7.5 7.5 0 0 1 15 0" />
                </svg>
            `
        },
        { 
            name: "Pembayaran SPP", 
            url: "{{ route('santri.pembayaran.index') }}", 
            category: "Pembayaran", 
            icon: `
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-5 h-5 {{ Request::is('santri/pembayaran*') ? 'text-white' : 'text-emerald-400' }} 
                    group-hover:scale-110 transition-transform" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 
                        5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 
                        0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 
                        19.5 4.5h-15a2.25 2.25 0 0 0-2.25 
                        2.25v10.5A2.25 2.25 0 0 0 4.5 
                        19.5Z" />
                </svg>
            `
        },
        { 
            name: "Kwitansi Pembayaran", 
            url: "{{ route('santri.kwitansi.index') }}", 
            category: "Laporan", 
            icon: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ Request::is('santri/kwitansi*') ? 'text-white' :  'text-emerald-400' }} group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            `
        },
    ];

    function filterResults() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const resultsDiv = document.getElementById("searchResults");
        resultsDiv.innerHTML = "";

        if (input.trim() === "") {
            resultsDiv.innerHTML = `
                <div class='px-4 py-3 text-gray-500 text-sm border-b bg-gray-50'>
                    💡 <span class="font-semibold">Tips:</span> Ketik untuk mencari halaman santri
                </div>
            `;
            resultsDiv.classList.remove("hidden");
            return;
        }

        const filtered = pages.filter(page =>
            page.name.toLowerCase().includes(input) || 
            page.category.toLowerCase().includes(input)
        );

        if (filtered.length === 0) {
            resultsDiv.innerHTML = `
                <div class='px-4 py-3 text-center text-gray-500'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                        stroke-width="1.5" stroke="currentColor" 
                        class="w-12 h-12 mx-auto mb-2 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 
                            5.196 5.196a7.5 7.5 0 0 0 
                            10.607 10.607Z" />
                    </svg>
                    <p class="font-medium">Tidak ada hasil</p>
                    <p class="text-xs mt-1">Coba kata kunci lain</p>
                </div>
            `;
        } else {
            const grouped = {};
            filtered.forEach(page => {
                if (!grouped[page.category]) {
                    grouped[page.category] = [];
                }
                grouped[page.category].push(page);
            });

            Object.keys(grouped).forEach((category, index) => {
                if (index > 0) {
                    resultsDiv.innerHTML += `<div class="border-t border-gray-200"></div>`;
                }

                resultsDiv.innerHTML += `
                    <div class="px-4 py-2 bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wide">
                        ${category}
                    </div>
                `;

                grouped[category].forEach(page => {
                    const item = document.createElement("a");
                    item.href = page.url;
                    item.className = "flex items-center gap-3 px-4 py-3 hover:bg-blue-50 text-gray-700 transition-colors border-b border-gray-100 last:border-b-0";
                    item.innerHTML = `
                        <span class="w-5 h-5 flex items-center justify-center">${page.icon}</span>
                        <span class="font-medium">${page.name}</span>
                    `;
                    resultsDiv.appendChild(item);
                });
            });
        }

        resultsDiv.classList.remove("hidden");
    }

    document.addEventListener("click", function (e) {
        const resultsDiv = document.getElementById("searchResults");
        const inputDiv = document.getElementById("searchInput");
        if (!resultsDiv.contains(e.target) && !inputDiv.contains(e.target)) {
            resultsDiv.classList.add("hidden");
        }
    });

    document.getElementById("searchInput").addEventListener("keydown", function(e) {
        if (e.key === "Escape") {
            document.getElementById("searchResults").classList.add("hidden");
            this.blur();
        }
    });
</script>