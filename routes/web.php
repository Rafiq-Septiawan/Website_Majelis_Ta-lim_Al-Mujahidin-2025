<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');

    // Profil Admin
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

    // CRUD Santri - PENTING: Route search HARUS sebelum resource!
    Route::get('/santri/search', [SantriController::class, 'search'])->name('santri.search');
    Route::resource('santri', SantriController::class);

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/input', [PembayaranController::class, 'create'])->name('pembayaran.input');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/', [LaporanController::class, 'index'])->name('index');
    Route::get('/riwayat', [LaporanController::class, 'riwayat'])->name('riwayat');
    Route::get('/belum-bayar', [LaporanController::class, 'belumBayar'])->name('belum_bayar');
    Route::get('/cetak', [LaporanController::class, 'cetak'])->name('cetak');
    Route::get('/cards', [LaporanController::class, 'cards'])->name('cards');
    Route::post('/filter', [LaporanController::class, 'filter'])->name('filter');
    Route::get('/debug', [LaporanController::class, 'debug'])->name('debug');

    // Notifikasi
    Route::get('/notifikasi', [NotificationsController::class, 'index'])->name('notifications');
    Route::get('/notifikasi/fetch', [NotificationsController::class, 'fetch'])->name('notifications.fetch');
});

/*
|--------------------------------------------------------------------------
| HALAMAN SANTRI
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| PROFILE (GLOBAL)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| OTP (One Time Password)
|--------------------------------------------------------------------------
*/
Route::prefix('otp')->group(function () {
    Route::get('/', [OtpController::class, 'showForm'])->name('otp.form');
    Route::post('/', [OtpController::class, 'verify'])->name('otp.verify');
    Route::get('/generate', [OtpController::class, 'generateOtp'])->name('otp.generate');
});

/*
| AUTH ROUTES (LOGIN / REGISTER)
*/
require __DIR__ . '/auth.php';