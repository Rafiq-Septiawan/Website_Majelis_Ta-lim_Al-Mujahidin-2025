<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ================= Dashboard =================

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

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

require __DIR__.'/auth.php';
