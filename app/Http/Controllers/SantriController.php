<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Tampilkan semua data santri
     */
    public function index()
    {
        $santris = Santri::all();
        return view('admin.santri.index', compact('santris'));
    }

    /**
     * Form tambah santri
     */
    public function create()
    {
        return view('admin.santri.create');
    }

    /**
     * Simpan data santri baru
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

        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil ditambahkan.');
    }

    /**
     * Form edit santri
     */
    public function edit(Santri $santri)
    {
        return view('admin.santri.edit', compact('santri'));
    }

    /**
     * Update data santri
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

        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    /**
     * Hapus data santri
     */
    public function destroy(Santri $santri)
    {
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus.');
    }
}
