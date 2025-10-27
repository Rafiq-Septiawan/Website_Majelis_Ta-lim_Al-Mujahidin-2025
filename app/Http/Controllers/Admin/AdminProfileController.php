<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000',
        ], [
            'avatar.max'        => 'Ukuran foto maksimal 2MB.',
            'avatar.dimensions' => 'Dimensi foto minimal 200x200 dan maksimal 2000x2000 piksel.',
            'avatar.mimes'      => 'Format gambar harus jpg, jpeg, png, atau gif.',
        ]);

        if ($request->hasFile('avatar')) {

            if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
                Storage::disk('public')->delete($admin->avatar);
            }

            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('avatars', $filename, 'public');

            $admin->avatar = $path;
        }

        $admin->name    = $request->name;
        $admin->phone   = $request->phone;
        $admin->address = $request->address;
        $admin->email   = $request->email;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'avatar'  => $admin->avatar ? asset('storage/' . $admin->avatar) : asset('images/default-avatar.png')
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah!'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diperbarui!'
        ]);
    }
}
