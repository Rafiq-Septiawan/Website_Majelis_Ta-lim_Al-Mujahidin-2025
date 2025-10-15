@extends('admin.layouts.admin')

@section('title', 'Edit Data Santri | Majelis Ta’lim Al-Mujahidin')

@section('content')

    <!-- Konten -->
    <div class="p-4 bg-white rounded-2xl">
        <div class="flex items-center justify-between mt-[60px] mb-6">
                <div class="flex items-center gap-4">
                    <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w- h-10 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">EDIT DATA SANTRI</h1>
                        <p class="text-sm text-gray-600 mt-1">Ubah data santri yang sudah terdaftar</p>
                    </div>
                </div>

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
                    <select name="jenis_kelamin" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                        class="w-[600px] border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">{{ old('alamat', $santri->alamat) }}</textarea>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formEditSantri');
        
        if (form) {
            form.addEventListener('submit', function(e) {
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
                        
                        // Submit form (hapus event listener dulu agar tidak loop)
                        form.removeEventListener('submit', arguments.callee);
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endpush