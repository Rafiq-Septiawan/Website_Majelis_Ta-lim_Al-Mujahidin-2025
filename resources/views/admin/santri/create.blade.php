@extends('admin.layouts.admin')

@section('title', 'Tambah Data Santri | Majelis Ta’lim Al-Mujahidin')

@section('scroll', 'overflow-hidden')

@section('content')

    <!-- Konten -->
    <div class="p-4 bg-white rounded-2xl">
        <div class="flex items-center justify-between mt-[60px] mb-6">
            <div class="flex items-center gap-4">
                    <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">TAMBAH DATA SANTRI</h1>
                        <p class="text-sm text-gray-600 mt-1">Masukkan data santri baru yang telah mendaftar</p>
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
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Nomor Telepon -->
                <div class="-mt-[10px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                </div>

                <!-- Tanggal Lahir -->
                <div class="-mt-[10px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    
                    @php
                        $oldDate = old('tanggal_lahir', $santri->tanggal_lahir ?? '');
                        $tgl = $bln = $thn = '';
                        if($oldDate) {
                            $parts = explode('-', $oldDate);
                            $thn = $parts[0] ?? '';
                            $bln = $parts[1] ?? '';
                            $tgl = $parts[2] ?? '';
                        }
                    @endphp
                    
                    <div class="grid grid-cols-3 gap-2">
                        <!-- Tanggal -->
                        <select id="tanggal" name="tanggal" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                            <option value="">Tanggal</option>
                            @for($i = 1; $i <= 31; $i++)
                                @php $val = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                <option value="{{ $val }}" {{ $tgl == $val ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>

                        <!-- Bulan -->
                        <select id="bulan" name="bulan" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                            <option value="">Bulan</option>
                            @foreach ([
                                '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April',
                                '05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus',
                                '09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
                            ] as $num => $nama)
                                <option value="{{ $num }}" {{ $bln == $num ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>

                        <!-- Tahun -->
                        <select id="tahun" name="tahun" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition">
                            <option value="">Tahun</option>
                            @php
                                $currentYear = date('Y');
                                for($year = $currentYear; $year >= 1950; $year--) {
                                    $selected = ($thn == $year) ? 'selected' : '';
                                    echo "<option value='$year' $selected>$year</option>";
                                }
                            @endphp
                        </select>
                    </div>

                    <!-- Hidden input -->
                    <input type="hidden" id="tanggal_lahir" name="tanggal_lahir" value="{{ $oldDate }}" required>

                    @error('tanggal_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                        class="w-[600px] border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-500 transition"></textarea>
                </div>
            </div>
        </form>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const tanggalSelect = document.getElementById('tanggal');
        const bulanSelect = document.getElementById('bulan');
        const tahunSelect = document.getElementById('tahun');
        const hiddenInput = document.getElementById('tanggal_lahir');
        const form = document.getElementById('formSantri');

        // Fungsi update hidden input
        function updateHiddenInput() {
            const tgl = tanggalSelect.value;
            const bln = bulanSelect.value;
            const thn = tahunSelect.value;
            hiddenInput.value = (tgl && bln && thn) ? `${thn}-${bln}-${tgl}` : '';
        }

        [tanggalSelect, bulanSelect, tahunSelect].forEach(select => {
            select.addEventListener('change', () => {
                updateHiddenInput();
                if (select === bulanSelect || select === tahunSelect) {
                    // validasi jumlah hari
                    const bulan = parseInt(bulanSelect.value);
                    const tahun = parseInt(tahunSelect.value);
                    if (bulan && tahun) {
                        const maxDay = new Date(tahun, bulan, 0).getDate();
                        const currentTanggal = tanggalSelect.value;
                        tanggalSelect.innerHTML = '<option value="">Tanggal</option>';
                        for (let i = 1; i <= maxDay; i++) {
                            const val = String(i).padStart(2, '0');
                            const opt = document.createElement('option');
                            opt.value = val;
                            opt.textContent = i;
                            if (val === currentTanggal && i <= maxDay) opt.selected = true;
                            tanggalSelect.appendChild(opt);
                        }
                        updateHiddenInput();
                    }
                }
            });
        });

        // Submit form pakai fetch
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            updateHiddenInput(); // ✅ pastikan tanggal_lahir terupdate

            const formData = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json"
                    },
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    form.reset();
                    setTimeout(() => window.location.href = "{{ route('admin.santri.index') }}", 1600);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Data santri gagal disimpan.'
                    });
                }
            } catch (err) {
                console.error("❌ Error:", err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data.'
                });
            }
        });
    });
    </script>

@endsection
