<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    /**
     * Tampilkan form OTP
     */
    public function showForm()
    {
        return view('auth.otp');
    }

    /**
     * Generate OTP baru dan simpan ke session
     */
    public function generateOtp()
    {
        $otp = rand(100000, 999999); // OTP 6 digit
        session([
            'otp_code' => $otp,
            'otp_expire_at' => now()->addMinutes(5)
        ]);

        // Untuk sementara OTP ditulis di log (bisa dicek di storage/logs/laravel.log)
        Log::info("OTP User: " . $otp);

        return redirect()->route('otp.form')->with('status', 'Kode OTP telah dikirim. Silakan cek email/log.');
    }

    /**
     * Verifikasi OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $sessionOtp = session('otp_code');
        $expiredAt = session('otp_expire_at');

        if (!$sessionOtp || !$expiredAt) {
            return back()->withErrors(['otp' => 'Kode OTP tidak ditemukan. Silakan minta ulang.']);
        }

        if (now()->gt($expiredAt)) {
            session()->forget(['otp_code', 'otp_expire_at']);
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        if ($request->otp == $sessionOtp) {
            session()->forget(['otp_code', 'otp_expire_at']);
            return redirect()->route('dashboard')->with('success', 'OTP berhasil diverifikasi.');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah.']);
    }
}
