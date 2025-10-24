<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\Santri;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function index()
    {
        $santri = Santri::where('user_id', Auth::id())->first();

        if (!$santri) {
            return view('santri.kwitansi.index', [
                'error' => 'Data santri tidak ditemukan.',
                'kwitansis' => collect(),
                'santri' => null,
            ]);
        }

        $kwitansis = Pembayaran::where('santri_id', $santri->id)
            ->where('status', 'Lunas')
            ->orderBy('tanggal_bayar', 'desc')
            ->get();

        return view('santri.kwitansi.index', compact('kwitansis', 'santri'));
    }

    public function cetak($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $santri = $pembayaran->santri;
        $nomorKwitansi = 'KW-' . str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT);

        return view('santri.kwitansi.cetak', compact('pembayaran', 'santri', 'nomorKwitansi'));
    }
}