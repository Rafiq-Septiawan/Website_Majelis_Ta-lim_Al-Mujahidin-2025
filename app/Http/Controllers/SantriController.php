<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Santri::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('wali', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $santris = $query->orderBy('nama', 'asc')->paginate(10);
        return view('admin.santri.index', compact('santris'));
    }

    public function create()
    {
        return view('admin.santri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'wali'          => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
        ]);

        $gender = $request->jenis_kelamin;

        Santri::create([
            'nama'          => $request->nama,
            'jenis_kelamin' => $gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'wali'          => $request->wali,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil disimpan!'
            ]);
        }

        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function edit(Santri $santri)
    {
        $santri->jenis_kelamin = $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
        return view('admin.santri.edit', compact('santri'));
    }

    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'wali'          => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
        ]);

        // Konversi nilai dari form ke format database
        $genderInput = $request->jenis_kelamin;
        if ($genderInput === 'Laki-laki' || $genderInput === 'L') {
            $gender = 'Laki-laki';
        } elseif ($genderInput === 'Perempuan' || $genderInput === 'P') {
            $gender = 'Perempuan';
        } else {
            $gender = null;
        }

        // Update data santri
        $santri->update([
            'nama'          => $request->nama,
            'jenis_kelamin' => $gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'wali'          => $request->wali,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
        ]);

        if ($santri->user_id && $santri->user) {
            $santri->user->update([
                'name'    => $request->nama,
                'phone'   => $request->telepon,
                'address' => $request->alamat,
            ]);
        }

        DB::table('pembayarans')
            ->where('santri_id', $santri->id)
            ->update(['nama_santri' => $request->nama]);

        if (Schema::hasColumn('tagihans', 'nama_santri')) {
            DB::table('tagihans')
                ->where('user_id', $santri->user_id)
                ->update(['nama_santri' => $request->nama]);
        }

        // Respons
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil diperbarui!'
            ]);
        }

        return redirect()->route('admin.santri.index')
                        ->with('success', 'Data santri berhasil diperbarui dan tersinkron ke semua tabel.');
    }

    public function destroy(Request $request, $id)
    {
        $santri = Santri::find($id);

        if (!$santri) {
            return response()->json([
                'success' => false,
                'message' => 'Data santri tidak ditemukan!'
            ], 404);
        }

        $santri->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil dihapus!'
            ]);
        }

        return redirect()->route('admin.santri.index')
                        ->with('success', 'Data santri berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('nama_santri');

        if (!$keyword) {
            return response()->json([]);
        }

        \Carbon\Carbon::setLocale('id');
        $santris = Santri::where('nama', 'like', "%{$keyword}%")
            ->select('id', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'wali', 'alamat', 'telepon')
            ->orderBy('nama', 'asc')
            ->limit(10)
            ->get();

        $santris = $santris->map(function ($santri) {
            if (!empty($santri->tanggal_lahir)) {
                try {
                    $santri->tanggal_lahir = \Carbon\Carbon::parse($santri->tanggal_lahir)
                        ->translatedFormat('d F Y');
                } catch (\Exception $e) {
                    
                }
            } else {
                $santri->tanggal_lahir = null;
            }
            return $santri;
        })->values();

        return response()->json($santris);
    }
}
