<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * 🔹 Tampilkan semua data santri
     */
    public function index()
    {
        $santris = Santri::all();
        $santris = Santri::orderBy('nama', 'asc')->paginate(10);
        return view('admin.santri.index', compact('santris'));
    }

    /**
     * 🔹 Form tambah santri
     */
    public function create()
    {
        return view('admin.santri.create');
    }

    /**
     * 🔹 Simpan data santri baru
     */
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

        Santri::create($request->all());

        // Jika request datang dari AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil disimpan!'
            ], 200);
        }

        // Jika dari form biasa
        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil ditambahkan.');
    }

    /**
     * 🔹 Form edit santri
     */
    public function edit(Santri $santri)
    {
        return view('admin.santri.edit', compact('santri'));
    }

    /**
     * 🔹 Update data santri
     */
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

        $santri->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil diperbarui!'
            ], 200);
        }

        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil diperbarui.');
    }

    /**
     * 🔹 Hapus data santri
     */
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

        /**
     * 🔍 AJAX: Cari santri berdasarkan nama (live search)
     */
    public function search(Request $request) {
        $keyword = $request->nama_santri;
        $santris = Santri::where('nama', 'like', "%{$keyword}%")->get();
        return response()->json($santris);
    }
}
