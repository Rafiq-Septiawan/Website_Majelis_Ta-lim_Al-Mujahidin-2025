<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

// HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});

// ================= HALAMAN ADMIN =================
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Profil Admin
    Route::get('/profile', fn() => view('admin.profile.index'))->name('profile.index');
    Route::get('/profile/edit', fn() => view('admin.profile.edit'))->name('profile.edit');

    // CRUD Santri
    Route::resource('santri', SantriController::class);

    // Pembayaran
    Route::get('/pembayaran/input', fn() => view('admin.pembayaran.input'))->name('pembayaran.input');

    // Laporan
    Route::get('/laporan', fn() => view('admin.laporan'))->name('laporan');

    // Notifikasi
    Route::get('/notifications', fn() => view('admin.notifications'))->name('notifications');
});


// ================= DASHBOARD SANTRI =================
Route::get('/santri/dashboard', function () {
    return view('santri.dashboard');
})->middleware(['auth', 'verified'])->name('santri.dashboard');

// ================= PROFILE =================
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
require __DIR__.'/auth.php';
