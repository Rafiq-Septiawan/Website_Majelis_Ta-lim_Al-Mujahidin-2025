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

        // ✅ Status pakai string 'Lunas'
        $sudahLunas = Pembayaran::where('status', 'Lunas')
            ->distinct('santri_id')
            ->count('santri_id');

        // Ambil ID santri yang sudah bayar (status Lunas)
        $idSantriSudahBayar = Pembayaran::where('status', 'Lunas')
            ->pluck('santri_id')
            ->unique();

        $jumlahBelumBayar = Santri::whereNotIn('id', $idSantriSudahBayar)->count();

        $totalBulanIni = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->where('status', 'Lunas')
            ->sum('jumlah_bayar');

        $pembayaranTerbaru = Pembayaran::join('santris', 'pembayarans.santri_id', '=', 'santris.id')
            ->select(
                'pembayarans.id',
                'pembayarans.santri_id',
                'santris.nama as nama_santri',
                'pembayarans.bulan',
                'pembayarans.jumlah_bayar',
                'pembayarans.tanggal_bayar',
                'pembayarans.status'
            )
            ->where('pembayarans.status', 'Lunas')
            ->orderBy('pembayarans.tanggal_bayar', 'desc')
            ->orderBy('pembayarans.created_at', 'desc')
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
        $idSantriSudahBayar = Pembayaran::where('status', 'Lunas')
            ->pluck('santri_id')
            ->unique();

        return response()->json([
            'totalSantri' => Santri::count(),
            'sudahLunas' => Pembayaran::where('status', 'Lunas')
                ->distinct('santri_id')
                ->count('santri_id'),
            'belumBayar' => Santri::whereNotIn('id', $idSantriSudahBayar)->count(),
            'bulanIni' => Pembayaran::whereMonth('tanggal_bayar', now()->month)
                ->whereYear('tanggal_bayar', now()->year)
                ->where('status', 'Lunas')
                ->sum('jumlah_bayar'),

            'pembayaranTerbaru' => Pembayaran::join('santris', 'pembayarans.santri_id', '=', 'santris.id')
                ->select(
                    'pembayarans.id',
                    'pembayarans.santri_id',
                    'santris.nama as nama_santri',
                    'pembayarans.bulan',
                    'pembayarans.jumlah_bayar',
                    'pembayarans.tanggal_bayar',
                    'pembayarans.status'
                )
                ->where('pembayarans.status', 'Lunas')
                ->orderBy('pembayarans.tanggal_bayar', 'desc')
                ->orderBy('pembayarans.created_at', 'desc')
                ->take(5)
                ->get(),

            'santriBelumBayar' => Santri::whereNotIn('id', $idSantriSudahBayar)
                ->select('id', 'nama', 'wali', 'telepon')
                ->get(),
        ]);
    }
}
