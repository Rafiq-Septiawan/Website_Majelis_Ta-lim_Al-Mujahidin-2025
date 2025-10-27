<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Santri\PembayaranController as SantriPembayaranController;
use App\Http\Controllers\Admin\NotificationsController as AdminNotificationsController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Santri\SantriProfileController;
use App\Http\Controllers\Santri\NotificationsController as SantriNotificationsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// HALAMAN UTAMA //
Route::get('/', function () {
    return view('welcome');
});

// LOGIN DAN LOGOUT //
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN //
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'isAdmin'])
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');

    // Profil Admin
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

    // CRUD Santri
    Route::get('/santri/search', [SantriController::class, 'search'])->name('santri.search');
    Route::resource('santri', SantriController::class);

    // Pembayaran
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/input', [AdminPembayaranController::class, 'create'])->name('pembayaran.input');
    Route::post('/pembayaran/store', [AdminPembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');

    Route::get('/', [LaporanController::class, 'index'])->name('index');
    Route::get('/riwayat', [LaporanController::class, 'riwayat'])->name('riwayat');
    Route::get('/belum-bayar', [LaporanController::class, 'belumBayar'])->name('belum_bayar');
    Route::get('/cetak', [LaporanController::class, 'cetak'])->name('cetak');
    Route::get('/cards', [LaporanController::class, 'cards'])->name('cards');
    Route::get('/debug', [LaporanController::class, 'debug'])->name('debug');

    // Notifikasi
    Route::get('/notifikasi', [AdminNotificationsController::class, 'index'])->name('notifications');
    Route::get('/notifikasi/fetch', [AdminNotificationsController::class, 'fetch'])->name('notifications.fetch');

    // Cetak Laporan
    Route::get('laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan_cetak');
});


// SANTRI
Route::prefix('santri')
    ->middleware(['auth', 'verified', 'isSantri'])
    ->name('santri.')
    ->group(function () {
        
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Santri\DashboardController::class, 'index'])->name('dashboard');

    // Profil Santri
    Route::get('/profile', [SantriProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [SantriProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [SantriProfileController::class, 'updatePassword'])->name('profile.password');

    // Pembayaran
    Route::get('/pembayaran', [SantriPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [SantriPembayaranController::class, 'store'])->name('pembayaran.store');
    
    // Kwitansi 
    Route::get('/kwitansi', [\App\Http\Controllers\Santri\KwitansiController::class, 'index'])->name('kwitansi.index');
    Route::get('/kwitansi/cetak/{id}', [\App\Http\Controllers\Santri\KwitansiController::class, 'cetak'])->name('kwitansi.cetak');
    
    // Notifikasi
    Route::get('/notifications', [SantriNotificationsController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/fetch', [SantriNotificationsController::class, 'fetchNotifications'])->name('notifications.fetch');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// OTP
Route::prefix('otp')->group(function () {
    Route::get('/', [OtpController::class, 'showForm'])->name('otp.form');
    Route::post('/', [OtpController::class, 'verify'])->name('otp.verify');
    Route::get('/generate', [OtpController::class, 'generateOtp'])->name('otp.generate');
});

// Login Register
require __DIR__ . '/auth.php';