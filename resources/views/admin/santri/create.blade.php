@extends('admin.layouts.admin')

@section('title', 'Tambah Data Santri | Majelis Ta’lim Al-Mujahidin')

@section('scroll', 'overflow-hidden')

@section('content')

    <!-- Konten -->
        <div class="p-4 bg-white rounded-2xl">

            <!-- Header + Tombol -->
            <div class="flex items-center justify-between mt-[60px] mb-6">
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
                    TAMBAH DATA SANTRI
                </h1>

                <!-- Tombol kembali -->
                <button onclick="window.history.back()"
                    class="flex items-center gap-1 bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                    Kembali
                </button>
            </div>
            
            <!-- Form Input Santri -->
            <form id="formSantri" action="{{ route('admin.santri.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap..."
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                    </div>

                    <!-- Nama Wali -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Wali Santri</label>
                        <input type="text" name="wali" placeholder="Nama wali santri..."
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="-mt-[10px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="-mt-[10px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="-mt-[17px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end items-end">
                        <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-teal-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
                            Simpan
                        </button>
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2 -mt-[10px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap..."
                            class="w-[551px] border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition"></textarea>
                    </div>
                </div>
            </form>
        </div>
        

    <!-- Script SweetAlert2 untuk konfirmasi simpan -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("formSantri");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "X-Requested-With": "XMLHttpRequest", // penting biar Laravel deteksi AJAX
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(async (response) => {
                const text = await response.text();
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error("⚠️ Respons bukan JSON:", text);
                    throw new Error("Response invalid");
                }
            })
            .then((data) => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    form.reset();

                    // balik ke index santri
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.santri.index') }}";
                    }, 1600);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Data santri gagal disimpan.'
                    });
                }
            })
            .catch((err) => {
                console.error("❌ Error saat menyimpan:", err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data.'
                });
            });
        });
    });
    </script>

@endsection
