@extends('santri.layouts.santri')

@section("title", "Profil | Majelis Ta'lim Al-Mujahidin")

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css">
<style>
    #cropModal { 
        z-index: 999999 !important; 
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
    }
    #cropModal img { 
        max-height: 400px; 
        width: auto; 
        object-fit: contain; 
    }
    .cropper-view-box, 
    .cropper-face { 
        border-radius: 50%; 
    }
    #cropModal > div {
        position: relative;
        z-index: 1000000;
    }
</style>
@endpush

@section('content')
<div class="flex justify-between items-center mb-4 mt-[75px] mx-[20px]">
    <div class="flex items-center gap-4 mb-4">
        <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">PROFIL</h1>
            <p class="text-sm text-gray-600 mt-1">Atur data pribadi dan kelola akun Anda di sini</p>
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

<!-- Form Informasi Profil -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white shadow-sm rounded-lg p-4 ml-[15px] border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.2" stroke="currentColor" class="w-6 h-6">
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
                    src="{{ $santri->avatar ? asset('storage/' . $santri->avatar) : asset('images/default-avatar.png') }}"
                    class="size-[120px] rounded-full border-2 border-primary shadow-sm">
                <button type="button" onclick="document.getElementById('avatarInput').click()"
                    class="mt-2 text-xs text-primary hover:underline">Ubah Foto Profil</button>
                <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name ?? $santri->nama }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 mb-2">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">No Telepon</label>
                <input type="text" name="phone" value="{{ $santri->telepon }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 mb-2">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 mb-2">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Alamat</label>
                <textarea name="alamat" 
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 mb-6" 
                    rows="3">{{ $santri->alamat ?? '' }}</textarea>
            </div>
            <div class="text-right mt-3">
                <button type="submit"
                    class="bg-primary text-white px-4 py-1.5 font-semibold text-2sm rounded-md hover:bg-teal-700/80 transition">
                    SIMPAN
                </button>
            </div>
        </form>
    </div>

    <!-- Form Update Password -->
    <div class="bg-white shadow-sm rounded-lg p-4 mr-[15px] border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-700 mb-8 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.2" stroke="currentColor" class="w-6 h-6">
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
                <label class="text-sm font-medium text-gray-600">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password"
                    placeholder="Masukkan password saat ini"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8 mb-2">
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
                <label class="text-sm font-medium text-gray-600">Password Baru</label>
                <input type="password" id="new_password" name="new_password"
                    placeholder="Masukkan password baru"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8 mb-2">
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
                <label class="text-sm font-medium text-gray-600">Konfirmasi Password Baru</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    placeholder="Konfirmasi password baru"
                    class="w-full border rounded-md px-2 py-1.5 text-sm focus:ring focus:ring-primary/30 pr-8 mb-6">
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
                    class="bg-gray-300 text-gray-800 text-2sm font-semibold px-4 py-1.5 rounded-md hover:bg-gray-400 transition">BATAL</button>
                <button type="submit"
                    class="bg-primary text-white text-2sm font-semibold px-4 py-1.5 rounded-md hover:bg-teal-700/80 transition">UBAH</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>

<!-- Modal Crop Foto -->
<div id="cropModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center overflow-auto">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-[90%] max-w-[500px] relative z-[1000000]">
        <h3 class="text-center font-bold text-lg mb-4 text-gray-800">Atur Pemotongan Foto</h3>
        <div class="flex justify-center mb-4">
            <div class="max-w-full max-h-[400px] overflow-hidden rounded-lg">
                <img id="cropImage" class="max-w-full">
            </div>
        </div>
        <div class="flex justify-between gap-3">
            <button id="cancelCrop" class="flex-1 px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-semibold">
                Batal
            </button>
            <button id="saveCrop" class="flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-teal-700 transition font-semibold">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    function goBack() {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.history.back();
    }

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
                    cropModal.classList.add("flex");

                    if (cropper) cropper.destroy();
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        restore: false,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById("cancelCrop").addEventListener("click", () => {
            cropModal.classList.add("hidden");
            cropModal.classList.remove("flex");
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
                    cropModal.classList.remove("flex");
                });
            }
        });

    // SCRIPT UPDATE PROFIL
    const profileForm = document.getElementById("profileForm");

    profileForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(profileForm);

        fetch("{{ route('santri.profile.update') }}", {
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

        fetch("{{ route('santri.profile.password') }}", {
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
