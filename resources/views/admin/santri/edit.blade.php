@extends('admin.layouts.admin')

@section('title', 'Edit Data Santri | Majelis Ta’lim Al-Mujahidin')

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
                             0 0 0 12 12.75a5.995 5.995 
                             0 0 0-5.058 2.772m0 0a3 3 0 0 
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
                EDIT DATA SANTRI
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

        <!-- Form Edit -->
        <form id="formEditSantri" action="{{ route('admin.santri.update', $santri->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $santri->nama) }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                </div>

                <!-- Nama Wali -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Wali Santri</label>
                    <input type="text" name="wali" value="{{ old('wali', $santri->wali) }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                </div>

                <!-- Jenis Kelamin -->
                <div class="-mt-[10px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                        <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Nomor Telepon -->
                <div class="-mt-[10px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $santri->telepon) }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                </div>

                <!-- Tanggal Lahir -->
                <div class="-mt-[17px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                </div>

                <!-- Tombol Update -->
                <div class="flex justify-end items-end">
                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-teal-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
                        Update
                    </button>
                </div>

                <!-- Alamat -->
                <div class="sm:col-span-2 -mt-[10px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" required
                        class="w-[551px] border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">{{ old('alamat', $santri->alamat) }}</textarea>
                </div>
            </div>
        </form>
    </div>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleSidebar()"></div>

<script>
    // Alert Success dari session Laravel
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
        });
    @endif

    // Alert Error dari session Laravel
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#ef4444',
        });
    @endif

    // Handle form submit dengan konfirmasi
    document.getElementById('formEditSantri').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Update Data Santri?',
            text: "Apakah Anda yakin ingin menyimpan perubahan data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#14b8a6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit form
                this.submit();
            }
        });
    });
</script>

@endsection