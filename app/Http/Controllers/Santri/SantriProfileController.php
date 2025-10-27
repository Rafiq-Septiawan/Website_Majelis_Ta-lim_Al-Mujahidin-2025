<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SantriProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('santri');
        $santri = $user->santri; 

        return view('santri.profile.index', [
            'user' => $user,
            'santri' => $santri
        ]);
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan.']);
            }

            $santri = $user->santri;

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:500',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($santri) {
                $santri->update([
                    'nama' => $request->name,
                    'telepon' => $request->phone,
                    'alamat' => $request->alamat,
                ]);
            }

            if ($request->hasFile('avatar')) {
                if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                    Storage::delete('public/' . $user->avatar);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
                $user->update(['avatar' => $path]);
            }

            return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan.']);
            }

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Password saat ini salah!']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Password berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}