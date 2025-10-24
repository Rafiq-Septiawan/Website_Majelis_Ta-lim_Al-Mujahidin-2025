<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role'     => 'required|in:admin,santri',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Auto buat atau hubungkan data santri
        if ($request->role === 'santri') {
            // cari data santri yang namanya sama dan BELUM punya user_id
            $santri = \App\Models\Santri::where('nama', $request->name)
                        ->whereNull('user_id')
                        ->first();

            if ($santri) {
                // update user_id pada data santri yang sudah ada
                $santri->update(['user_id' => $user->id]);
            } else {
                // kalau belum ada data santri yang belum terhubung, buat data baru
                \App\Models\Santri::create([
                    'user_id'       => $user->id,
                    'nama'          => $user->name,
                    'jenis_kelamin' => 'Laki-Laki',
                    'tanggal_lahir' => now(),
                    'wali'          => '-',
                    'alamat'        => '-',
                    'telepon'       => '-',
                ]);
            }
        }

        event(new Registered($user));
        Auth::login($user);

        return $request->role === 'admin'
            ? redirect()->intended('/admin/dashboard')
            : redirect()->intended('/santri/dashboard');
    }

}
