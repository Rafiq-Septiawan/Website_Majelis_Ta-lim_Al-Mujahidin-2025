@extends('admin.layouts.admin')

@section("title", "Profil | Majelis Ta'lim Al-Mujahidin")

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css">
<style>
    #cropModal { z-index: 9999 !important; }
    #cropModal img { max-height: 400px; width: auto; object-fit: contain; }
    .cropper-view-box, .cropper-face { border-radius: 50%; }
</style>
@endpush

@section('content')
<div class="flex justify-between items-center mb-4 mt-[75px] mx-[20px]">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Profil Pengguna</h2>
        <p class="text-gray-500">Kelola informasi akun dan pengaturan profil Anda</p>
    </div>
    <!--   Tombol Kembali ke Dashboard --> 
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 bg-primary hover:bg-teal-700 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
        Kembali
    </a>
</div>

<!-- Form Informasi Profil -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white shadow-sm rounded-lg p-4 ml-[15px] border border-gray-200">
        <h3 class="text-base font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 
                    20.118a7.5 7.5 0 0 1 14.998 0A17.933 
                    17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
            </svg>
            Informasi Profil
        </h3>

        <form id="profileForm" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <!-- Foto Profil -->
            <div class="flex flex-col items-center mb-4">
                <img id="avatarPreview"
                    src="{{ $admin->avatar ? asset('storage/' . $admin->avatar) : asset('images/default-avatar.png') }}"
                    class="w-20 h-20 rounded-full border-2 border-primary shadow-sm">
                <button type="button" onclick="document.getElementById('avatarInput').click()"
                    class="mt-2 text-xs text-primary hover:underline">Ubah Foto Profil</button>
                <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden">
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $admin->name }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">No Telepon</label>
                <input type="text" name="phone" value="{{ $admin->phone ?? '' }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Email</label>
                <input type="email" name="email" value="{{ $admin->email }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Alamat</label>
                <textarea name="address"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30">{{ $admin->address ?? '' }}</textarea>
            </div>
            <div class="text-right mt-3">
                <button type="submit"
                    class="bg-primary text-white px-4 py-1.5 text-sm rounded-md hover:bg-teal-700/80 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Form Update Password -->
    <div class="bg-white shadow-sm rounded-lg p-4 mr-[15px] border border-gray-200">
        <h3 class="text-base font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 
                    1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 
                    17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 
                    .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
            </svg>
            Update Password
        </h3>

        <form id="passwordForm" class="space-y-3 relative">
            @csrf
            <div class="relative">
                <label class="text-xs font-medium text-gray-600">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password"
                    placeholder="Masukkan password saat ini"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8">
                <button type="button" onclick="togglePassword('current_password', this)"
                    class="absolute right-2 top-8 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 
                            7.51 7.36 4.5 12 4.5c4.637 0 8.573 3.007 
                            9.963 7.178.07.207.07.431 0 
                            .639C20.577 16.49 16.64 19.5 
                            12 19.5c-4.637 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            <div class="relative">
                <label class="text-xs font-medium text-gray-600">Password Baru</label>
                <input type="password" id="new_password" name="new_password"
                    placeholder="Masukkan password baru"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8">
                <button type="button" onclick="togglePassword('new_password', this)"
                    class="absolute right-2 top-8 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 
                            7.51 7.36 4.5 12 4.5c4.637 0 8.573 3.007 
                            9.963 7.178.07.207.07.431 0 
                            .639C20.577 16.49 16.64 19.5 
                            12 19.5c-4.637 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            <div class="relative">
                <label class="text-xs font-medium text-gray-600">Konfirmasi Password Baru</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    placeholder="Konfirmasi password baru"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8">
                <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                    class="absolute right-2 top-8 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 
                            7.51 7.36 4.5 12 4.5c4.637 0 8.573 3.007 
                            9.963 7.178.07.207.07.431 0 
                            .639C20.577 16.49 16.64 19.5 
                            12 19.5c-4.637 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            <div class="flex justify-between mt-3">
                <button type="reset"
                    class="bg-gray-300 text-gray-800 text-sm px-4 py-1.5 rounded-md hover:bg-gray-400 transition">Batal</button>
                <button type="submit"
                    class="bg-primary text-white text-sm px-4 py-1.5 rounded-md hover:bg-teal-700/80 transition">Ubah</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Crop Foto -->
<div id="cropModal" class="fixed inset-0 bg-black/70 flex justify-center items-center hidden overflow-auto"
     style="z-index: 99999;">
    <div class="bg-white p-4 rounded-lg shadow-lg w-[350px] sm:w-[400px] md:w-[450px]">
        <h3 class="text-center font-semibold mb-2 text-gray-800">Atur Pemotongan Foto</h3>
        <div class="flex justify-center">
            <img id="cropImage" class="max-w-full rounded-md">
        </div>
        <div class="flex justify-between mt-4">
            <button id="cancelCrop" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">Batal</button>
            <button id="saveCrop" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Toggle Password Visibility (GLOBAL FUNCTION)
    window.togglePassword = function(inputId, button) {
        const input = document.getElementById(inputId);
        
        const eyeIcon = `
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-4 h-4'>
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='M2.036 12.322a1.012 1.012 0 010-.639
                    C3.423 7.51 7.36 4.5 12 4.5
                    c4.637 0 8.573 3.007 9.963 7.178
                    .07.207.07.431 0 .639
                    C20.577 16.49 16.64 19.5 12 19.5
                    c-4.637 0-8.573-3.007-9.963-7.178z' />
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' />
            </svg>
        `;

        const eyeSlashIcon = `
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-4 h-4'>
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='M3.98 8.223A10.477 10.477 0 001.5 12
                    c1.676 4.257 6.03 7.5 10.5 7.5
                    1.886 0 3.676-.435 5.25-1.207M6.228 6.228
                    A10.45 10.45 0 0112 4.5
                    c4.47 0 8.824 3.243 10.5 7.5
                    a10.523 10.523 0 01-4.17 5.318M6.228 6.228
                    L3 3m3.228 3.228l12.544 12.544
                    M9.88 9.88a3 3 0 104.24 4.24' />
            </svg>
        `;

        if (input.type === "password") {
            input.type = "text";
            button.innerHTML = eyeSlashIcon;
        } else {
            input.type = "password";
            button.innerHTML = eyeIcon;
        }
    };

    // SCRIPT CROP FOTO
    let cropper;
    const avatarInput = document.getElementById("avatarInput");
    const avatarPreview = document.getElementById("avatarPreview");
    const cropModal = document.getElementById("cropModal");
    const cropImage = document.getElementById("cropImage");
    let oldAvatar = avatarPreview.src;

    avatarInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                cropImage.src = event.target.result;
                cropModal.classList.remove("hidden");

                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById("cancelCrop").addEventListener("click", () => {
        cropModal.classList.add("hidden");
        avatarPreview.src = oldAvatar;
        avatarInput.value = "";
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    document.getElementById("saveCrop").addEventListener("click", () => {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({ width: 400, height: 400 });
            canvas.toBlob((blob) => {
                const file = new File([blob], "avatar.jpg", { type: "image/jpeg" });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                avatarInput.files = dataTransfer.files;
                avatarPreview.src = canvas.toDataURL();
                oldAvatar = avatarPreview.src;

                cropper.destroy();
                cropper = null;
                cropModal.classList.add("hidden");
            });
        }
    });

    // SCRIPT UPDATE PROFIL
    const profileForm = document.getElementById("profileForm");

    profileForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(profileForm);

        fetch("{{ route('admin.profile.update') }}", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Profil berhasil diperbarui!",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: data.message || "Terjadi kesalahan!",
                });
            }
        })
        .catch(err => {
            console.error("Error saat update profil:", err);
            Swal.fire({
                icon: "error",
                title: "Gagal mengirim data ke server!"
            });
        });
    });

    // SCRIPT UPDATE PASSWORD
    const passwordForm = document.getElementById("passwordForm");

    passwordForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(passwordForm);

        fetch("{{ route('admin.profile.password') }}", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: data.message || "Password berhasil diperbarui!",
                    showConfirmButton: false,
                    timer: 1500
                });
                passwordForm.reset();
            } else {
                Swal.fire({
                    icon: "error",
                    title: data.message || "Gagal memperbarui password!"
                });
            }
        })
        .catch(err => {
            console.error("Error saat update password:", err);
            Swal.fire({
                icon: "error",
                title: "Terjadi kesalahan koneksi!"
            });
        });
    });

});
</script>
@endpush