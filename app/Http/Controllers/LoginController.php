<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 🔹 Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan file resources/views/auth/login.blade.php ada
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan remember me (kalau dicentang)
        $remember = $request->has('remember'); // true kalau checkbox dicentang

        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // 🔸 Redirect sesuai role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('santri.dashboard');
            }
        }

        // Kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Kamu sudah logout!');
    }
}
