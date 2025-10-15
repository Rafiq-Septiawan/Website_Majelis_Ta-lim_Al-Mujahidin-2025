<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Pembayaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSantri = Santri::count();

        $sudahLunas = Pembayaran::where('status', 'lunas')
            ->distinct('santri_id')
            ->count('santri_id');

        $idSantriSudahBayar = Pembayaran::pluck('santri_id')->unique();
        $jumlahBelumBayar = Santri::whereNotIn('id', $idSantriSudahBayar)->count();

        $totalBulanIni = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah_bayar');

        $pembayaranTerbaru = Pembayaran::select('id', 'santri_id', 'nama_santri', 'bulan', 'jumlah_bayar', 'tanggal_bayar', 'status')
            ->orderBy('tanggal_bayar', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $santriBelumBayar = Santri::whereNotIn('id', $idSantriSudahBayar)
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSantri',
            'sudahLunas',
            'jumlahBelumBayar',
            'totalBulanIni',
            'pembayaranTerbaru',
            'santriBelumBayar'
        ));
    }

    public function getData()
    {
        $idSantriSudahBayar = Pembayaran::pluck('santri_id')->unique();

        return response()->json([
            'totalSantri' => Santri::count(),
            'sudahLunas' => Pembayaran::where('status', 'lunas')
                ->distinct('santri_id')
                ->count('santri_id'),
            'belumBayar' => Santri::whereNotIn('id', $idSantriSudahBayar)->count(),
            'bulanIni' => Pembayaran::whereMonth('tanggal_bayar', now()->month)
                ->whereYear('tanggal_bayar', now()->year)
                ->sum('jumlah_bayar'),
            'pembayaranTerbaru' => Pembayaran::select('id', 'santri_id', 'nama_santri', 'bulan', 'jumlah_bayar', 'tanggal_bayar', 'status')
                ->orderBy('tanggal_bayar', 'desc')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(),
            'santriBelumBayar' => Santri::whereNotIn('id', $idSantriSudahBayar)
                ->select('id', 'nama', 'wali', 'telepon')
                ->get(),
        ]);
    }
}