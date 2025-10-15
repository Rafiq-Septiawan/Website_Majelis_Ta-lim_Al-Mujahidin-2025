@extends('admin.layouts.admin')

@section("title", "Input Pembayaran | Majelis Ta'lim Al-Mujahidin")

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <!-- Konten -->
    <div class="p-5 bg-white rounded-2xl">
        <!-- Judul Halaman -->
        <div class="flex items-center justify-between mt-[60px] mb-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">INPUT PEMBAYARAN</h1>
                    <p class="text-sm text-gray-600 mt-1">Input pembayaran santri</p>
                </div>
            </div>
            <button 
                onclick="goBack()" 
                class="flex items-center bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
                Kembali
            </button>
         </div>

        <!-- Dua Kolom: Cari Santri & Form Pembayaran (Versi Compact) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4">
            <!-- Cari Data Santri -->
            <div class="bg-gray-100 rounded-lg p-5 -ml-4 shadow-inner">
                <h2 class="text-base font-bold mb-3 text-gray-700 text-center">CARI SANTRI</h2>
                <div class="flex flex-col gap-2">
                    <label for="nama_santri" class="font-medium text-gray-700 text-sm">Nama Santri</label>
                    <div class="flex items-center bg-white rounded-md shadow-sm relative">
                        <input type="text" id="nama_santri" name="nama_santri" placeholder="Masukkan Nama Santri" autocomplete="off"
                            class="w-full p-1.5 rounded-l-md border border-gray-300 text-sm focus:outline-none focus:ring-emerald-400">
                        <button id="btnCari" class="bg-primary hover:bg-teal-700 text-white font-semibold px-3 py-1.5 rounded-r-md text-sm transition">
                            CARI
                        </button>
                        <div id="searchResults" class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden z-50 max-h-52 overflow-y-auto"></div>
                    </div>
                </div>

                <!-- Informasi Santri yang Dipilih -->
                <div id="santriInfo" class="mt-4 hidden">
                    <div class="bg-white from-gray-50 to-gray-100 rounded-lg p-3 shadow-md border-l-4 border-primary text-sm">
                        <h3 class="font-semibold text-emerald-700 mb-2">Data Santri Terpilih:</h3>
                        <div class="space-y-1">
                            <p><span class="font-medium">Nama:</span> <span id="infoNama"></span></p>
                            <p><span class="font-medium">Jenis Kelamin:</span> <span id="infoJK"></span></p>
                            <p><span class="font-medium">Tanggal Lahir:</span> <span id="infoTglLahir"></span></p>
                            <p><span class="font-medium">Wali:</span> <span id="infoWali"></span></p>
                            <p><span class="font-medium">Alamat:</span> <span id="infoAlamat"></span></p>
                            <p><span class="font-medium">Telepon:</span> <span id="infoTelepon"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Input Pembayaran -->
            <div class="bg-gray-100 rounded-lg p-5 -mr-4 shadow-inner">
                <h2 class="text-base font-bold mb-3 text-gray-700 text-center">FORM INPUT PEMBAYARAN</h2>

                <form id="formPembayaran" action="{{ route('admin.pembayaran.store') }}" method="POST" class="flex flex-col gap-3 text-sm">
                    @csrf
                    <input type="hidden" id="santri_id" name="santri_id">
                    <input type="hidden" id="nominal_hidden" name="nominal">
                    <input type="hidden" id="tanggal" name="tanggal">

                    <div>
                        <label for="nama_santri_display" class="font-medium text-gray-700">Nama Santri</label>
                        <input type="text" id="nama_santri_display" name="nama_santri" readonly
                            placeholder="Pilih santri terlebih dahulu"
                            class="w-full mt-1 p-1.5 rounded-md border border-gray-300 bg-gray-50 text-gray-600 text-sm">
                    </div>

                    <div>
                        <label for="nominal_display" class="font-medium text-gray-700">Nominal Pembayaran</label>
                        <div class="relative mt-1">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                            <input type="text" id="nominal_display" placeholder="0"
                                class="w-full pl-8 pr-2 py-1.5 rounded-md border border-gray-300 focus:outline-none focus:ring-emerald-400 text-gray-800 font-medium text-sm">
                        </div>
                        <p id="nominal_warning" 
                            class="text-xs text-red-500 mt-1 min-h-[16px] opacity-0 transition-opacity duration-200">
                            Minimal pembayaran Rp 50.000
                        </p>
                    </div>

                    <div>
                        <label for="bulan" class="font-medium text-gray-700">Bulan Pembayaran</label>
                        <input type="month" id="bulan" name="bulan"
                            class="w-full mt-1 mb-6 p-1.5 rounded-md border border-gray-300 focus:outline-none focus:ring-emerald-400 text-sm" required>
                    </div>

                    <button type="submit" class="bg-primary hover:bg-teal-700 text-white font-semibold py-2 rounded-md shadow-md hover:shadow-lg transition text-center text-sm">
                        SIMPAN
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function goBack() {
    // hapus state biar alert ga muncul dua kali
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.history.back();
    }

    document.addEventListener('DOMContentLoaded', function() {
        
        // Alert Success/Error dari Laravel
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                confirmButtonColor: '#14b8a6',
                timer: 3000,
                timerProgressBar: true,
            }).then(() => {
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        @endif

        // Format Rupiah
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function unformatRupiah(rupiah) {
            return parseInt(rupiah.replace(/\./g, '')) || 0;
        }

        // Input Nominal dengan Format Rupiah + Validasi Minimal
        const nominalDisplay = document.getElementById('nominal_display');
        const nominalHidden = document.getElementById('nominal_hidden');
        const warningText = document.getElementById('nominal_warning');

        nominalDisplay.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // hanya angka

            if (value) {
                const angka = parseInt(value);

                // Validasi minimal Rp 50.000
                if (angka < 50000) {
                    warningText.classList.add('opacity-100');
                    warningText.classList.remove('opacity-0');
                } else {
                    warningText.classList.add('opacity-0');
                    warningText.classList.remove('opacity-100');
                }

                e.target.value = formatRupiah(value);
                nominalHidden.value = angka;
            } else {
                e.target.value = '';
                nominalHidden.value = '';
                warningText.classList.add('opacity-0');
                warningText.classList.remove('opacity-100');
            }
        });

        // AJAX Search Santri
        const inputNamaSantri = document.getElementById('nama_santri');
        const searchResults = document.getElementById('searchResults');
        const santriInfo = document.getElementById('santriInfo');
        const btnCari = document.getElementById('btnCari');

        let selectedSantri = null;

        // Live search saat mengetik
        inputNamaSantri.addEventListener('input', function() {
            const keyword = this.value.trim();
            
            // Jika search bar kosong, sembunyikan semua
            if (keyword.length < 1) {
                searchResults.classList.add('hidden');
                santriInfo.classList.add('hidden');
                
                // Reset form pembayaran jika search bar dikosongkan
                if (keyword.length === 0) {
                    document.getElementById('santri_id').value = '';
                    document.getElementById('nama_santri_display').value = '';
                    selectedSantri = null;
                }
                return;
            }

            // Fetch data santri
            fetch(`/admin/santri/search?nama_santri=${encodeURIComponent(keyword)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data diterima:', data); // Debug
                
                if (data.length > 0) {
                    let html = '<ul class="divide-y divide-gray-200">';
                    data.forEach(santri => {
                        html += `
                            <li class="p-3 hover:bg-emerald-50 cursor-pointer transition" onclick='selectSantri(${JSON.stringify(santri)})'>
                                <div class="font-semibold text-gray-800">${santri.nama}</div>
                                <div class="text-xs text-gray-500">Wali: ${santri.wali} | ${santri.jenis_kelamin}</div>
                            </li>
                        `;
                    });
                    html += '</ul>';
                    searchResults.innerHTML = html;
                    searchResults.classList.remove('hidden');
                } else {
                    searchResults.innerHTML = '<div class="p-3 text-center text-gray-500">Tidak ada data ditemukan</div>';
                    searchResults.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<div class="p-3 text-center text-red-500">Terjadi kesalahan: ' + error.message + '</div>';
                searchResults.classList.remove('hidden');
            });
        });

        // Pilih santri dari hasil pencarian (HARUS GLOBAL)
        window.selectSantri = function(santri) {
            selectedSantri = santri;
            
            // Isi form
            document.getElementById('santri_id').value = santri.id;
            document.getElementById('nama_santri_display').value = santri.nama;
            document.getElementById('nama_santri').value = santri.nama;
            
            // Format tanggal lahir jadi "14 Oktober 2025"
                let tglLahir = santri.tanggal_lahir;
                const parsedDate = new Date(tglLahir + "T00:00:00");
                const formatted = parsedDate.toLocaleDateString("id-ID", {
                    day: "2-digit",
                    month: "long",
                    year: "numeric"
                });

            // Tampilkan info santri
            document.getElementById('infoNama').textContent = santri.nama;
            document.getElementById('infoJK').textContent = santri.jenis_kelamin;
            document.getElementById('infoTglLahir').textContent = santri.tanggal_lahir;
            document.getElementById('infoWali').textContent = santri.wali;
            document.getElementById('infoAlamat').textContent = santri.alamat;
            document.getElementById('infoTelepon').textContent = santri.telepon;
            
            santriInfo.classList.remove('hidden');
            searchResults.classList.add('hidden');
        };

        // Sembunyikan dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!searchResults.contains(e.target) && e.target !== inputNamaSantri) {
                searchResults.classList.add('hidden');
            }
        });

        // Set tanggal hari ini sebagai default
        document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];

        // Handle form submit dengan validasi
        document.getElementById('formPembayaran').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const namaSantri = document.getElementById('nama_santri_display').value;
            const nominal = nominalHidden.value;
            const bulan = document.getElementById('bulan').value;

            // Validasi
            if (!namaSantri) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih santri terlebih dahulu',
                    confirmButtonColor: '#f59e0b',
                });
                return;
            }

            if (!nominal || parseInt(nominal) < 50000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Nominal pembayaran minimal Rp 50.000',
                    confirmButtonColor: '#f59e0b',
                });
                return;
            }

            if (!bulan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih bulan pembayaran',
                    confirmButtonColor: '#f59e0b',
                });
                return;
            }

            // Konfirmasi sebelum simpan
            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                html: `
                    <div class="text-left">
                        <p><strong>Nama Santri:</strong> ${namaSantri}</p>
                        <p><strong>Nominal:</strong> Rp ${formatRupiah(nominal)}</p>
                        <p><strong>Tanggal:</strong> ${new Date(bulan).toLocaleDateString("id-ID", {
                            day: "2-digit",
                            month: "long",
                            year: "numeric"
                        })}</p>
                    </div>
                    <br>
                    <p>Apakah data sudah benar?</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#14b8a6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menyimpan Data...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form
                    e.target.submit();
                }
            });
        });
    });
</script>
@endpush