<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Santri;

class PembayaranController extends Controller
{
    public function create()
    {
        return view('admin.pembayaran.input');
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'santri_id' => 'required|exists:santris,id',
                'nama_santri' => 'required',
                'nominal' => 'required|numeric|min:50000',
                'bulan' => 'required',
            ]);

            $nominal = (int) $request->nominal;
            $bulanAwal = $request->bulan;
            $tanggal = now()->format('Y-m-d');
            $jumlahBulan = floor($nominal / 50000);

            // Daftar bulan Indonesia
            $bulanIndo = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];

            // Parse bulan awal
            list($tahun, $bulan) = explode('-', $bulanAwal);
            $indexBulan = (int) $bulan;

            // Simpan pembayaran untuk beberapa bulan
            for ($i = 0; $i < $jumlahBulan; $i++) {
                $bulanIndex = (($indexBulan + $i - 1) % 12) + 1;
                $bulanBayar = $bulanIndo[$bulanIndex];

                Pembayaran::create([
                    'santri_id'     => $request->santri_id,
                    'nama_santri'   => $request->nama_santri,
                    'bulan'         => $bulanBayar,
                    'jumlah_bayar'  => 50000,
                    'tanggal_bayar' => $tanggal,
                    'status'        => 'lunas',
                ]);
            }

            return redirect()->route('admin.pembayaran.input')
                ->with('success', "Pembayaran Rp " . number_format($nominal, 0, ',', '.') . " berhasil disimpan untuk $jumlahBulan bulan!");

        } catch (\Exception $e) {
            return redirect()->route('admin.pembayaran.input')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function index()
    {
        return view('admin.pembayaran.input');
    }
}