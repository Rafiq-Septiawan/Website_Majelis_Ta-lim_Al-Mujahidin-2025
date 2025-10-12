<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PembayaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// ================= HALAMAN UTAMA =================
Route::get('/', function () {
    return view('welcome');
});

// ================= INGAT SAYA =================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= HALAMAN ADMIN ================= 
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');

    // Profil Admin
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

    // CRUD Santri
    Route::resource('santri', SantriController::class);
    Route::delete('/santri/{id}', [SantriController::class, 'destroy'])->name('santri.destroy');
    // PENTING: Route search harus di atas resource route atau gunakan path yang lebih spesifik
    Route::get('/santri-search', [SantriController::class, 'search'])->name('santri.search');

    // halaman input pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/input', [PembayaranController::class, 'create'])->name('pembayaran.input');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');

    // Laporan
    Route::view('/laporan', 'admin.laporan')->name('laporan');

    // Notifikasi
    Route::view('/notifications', 'admin.notifications')->name('notifications');
});



// ================= HALAMAN SANTRI =================
Route::prefix('santri')->middleware(['auth', 'verified'])->name('santri.')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'santri.dashboard')->name('dashboard');

    // Profil Santri
    Route::view('/profile', 'santri.profile.index')->name('profile.index');
    Route::view('/profile/edit', 'santri.profile.edit')->name('profile.edit');

    // Laporan
    Route::view('/laporan', 'santri.laporan')->name('laporan');

    // Notifikasi
    Route::view('/notifications', 'santri.notifications')->name('notifications');
});

// ================= PROFILE (GLOBAL) =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= OTP =================
Route::prefix('otp')->group(function () {
    Route::get('/', [OtpController::class, 'showForm'])->name('otp.form');
    Route::post('/', [OtpController::class, 'verify'])->name('otp.verify');
    Route::get('/generate', [OtpController::class, 'generateOtp'])->name('otp.generate');
});

// ================= LOGOUT =================
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Auth routes (login/register)
require __DIR__ . '/auth.php';
