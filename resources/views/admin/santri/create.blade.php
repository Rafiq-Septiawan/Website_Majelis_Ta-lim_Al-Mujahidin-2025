@extends('layouts.app') {{-- Sesuaikan dengan layout utama lo --}}

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Tambah Data Santri</h2>

    <form action="{{ route('santri.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block mb-1 font-medium">Nama Santri</label>
            <input type="text" name="nama" class="border w-full p-2 rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="border w-full p-2 rounded">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="border w-full p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Wali Santri</label>
            <input type="text" name="wali" class="border w-full p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Alamat</label>
            <textarea name="alamat" class="border w-full p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">No. Telepon</label>
            <input type="text" name="telepon" class="border w-full p-2 rounded">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('santri.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 mr-2">
                Batal
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
