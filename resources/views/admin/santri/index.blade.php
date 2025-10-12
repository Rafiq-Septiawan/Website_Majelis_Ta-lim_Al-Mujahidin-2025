@extends('admin.layouts.admin')

@section('title', 'Data Santri | Majelis Ta’lim Al-Mujahidin')

@section('content')

    <!-- Konten -->
        <div class="p-6 bg-white rounded-2xl flex-1 flex flex-col">

            <!-- Judul Halaman -->
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

@endsection
