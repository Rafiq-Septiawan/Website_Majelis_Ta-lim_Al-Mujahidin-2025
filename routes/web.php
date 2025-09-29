<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

Route::get('/', function () {
    return view('welcome');
});

// ================= HALAMAN ADMIN =================

// Dashboard Admin
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/laporan', fn() => view('admin.laporan'))->name('laporan');
    Route::get('/profil', fn() => view('admin.profil'))->name('profil');
});

// Fungsi CRUD Santri //
Route::prefix('admin')->group(function () {
    Route::resource('santri', \App\Http\Controllers\SantriController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // route CRUD santri
    Route::resource('santri', SantriController::class);
});

// Dashboard Santri
Route::get('/santri/dashboard', function () {
    return view('dashboard.santri');
})->middleware(['auth', 'verified'])->name('santri.dashboard');

// ================= Profile =================
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

// ================= Logout =================
Route::post('/logout', function (Request $request) {
    Auth::logout(); 
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
