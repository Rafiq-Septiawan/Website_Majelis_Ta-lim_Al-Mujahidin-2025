<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Santri;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $totalSantri = Santri::count();
        
        $biayaSppPerBulan = 50000;

        $expectedThisMonth = $totalSantri * $biayaSppPerBulan;

        $totalBulanIni = Pembayaran::whereMonth('tanggal_bayar', Carbon::now()->month)
            ->whereYear('tanggal_bayar', Carbon::now()->year)
            ->sum('jumlah_bayar');

        $totalTunggakan = max(0, $expectedThisMonth - $totalBulanIni);

        $santriBelumBayar = Santri::whereDoesntHave('pembayarans', function($q) {
            $q->whereMonth('tanggal_bayar', Carbon::now()->month)
            ->whereYear('tanggal_bayar', Carbon::now()->year);
        })
        ->orderBy('nama', 'asc')
        ->get()
        ->map(function ($santri) {
            $santri->jatuh_tempo = Carbon::createFromDate(
                now()->year,
                now()->month,
                1
            )->translatedFormat('d F Y');
            return $santri;
        });

        $jumlahBelumBayar = $santriBelumBayar->count();

        $jumlahLunas = $totalSantri - $jumlahBelumBayar;

        $persentasePembayaran = $totalSantri > 0
            ? round(($jumlahLunas / $totalSantri) * 100, 1)
            : 0;

        $riwayatPembayaran = Pembayaran::with('santri')
            ->orderBy('tanggal_bayar', 'desc')
            ->limit(50)
            ->get();

        $totalPendapatan = Pembayaran::sum('jumlah_bayar');

        return view('admin.laporan.index', compact(
            'totalSantri',
            'biayaSppPerBulan',
            'expectedThisMonth',
            'totalBulanIni',
            'totalTunggakan',
            'jumlahBelumBayar',
            'santriBelumBayar',
            'jumlahLunas',
            'persentasePembayaran',
            'riwayatPembayaran',
            'totalPendapatan'
        ));
    }

    public function riwayat()
    {
        $riwayat = Pembayaran::with('santri')
            ->orderBy('tanggal_bayar', 'desc')
            ->paginate(50);

        return view('admin.laporan.riwayat', compact('riwayat'));
    }

    public function belumBayar()
    {
        $belumBayar = Santri::whereDoesntHave('pembayaran', function($query) {
            $query->whereMonth('tanggal_bayar', Carbon::now()->month)
                  ->whereYear('tanggal_bayar', Carbon::now()->year);
        })
        ->orderBy('nama', 'asc')
        ->get();

        return view('admin.laporan.belum_bayar', compact('belumBayar'));
    }

    public function cetak()
    {
        $tahunTarget = Carbon::now()->year;
        $bulanTarget = Carbon::now()->month;
        $namaBulanTarget = Carbon::now()->locale('id')->monthName;
        
        $santriSudahBayarIds = Pembayaran::where('bulan', $namaBulanTarget) 
            ->whereYear('tanggal_bayar', $tahunTarget)
            ->pluck('santri_id')
            ->unique();
        
        $santriBelumBayar = Santri::whereNotIn('id', $santriSudahBayarIds)
            ->get();
        
        $riwayatPembayaran = Pembayaran::with('santri')
            ->latest()
            ->limit(100)
            ->get();

        $totalSantri = Santri::count();
        $jumlahBelumBayar = $santriBelumBayar->count();
        
        $totalPendapatan = Pembayaran::sum('jumlah_bayar'); 
        
        $jumlahLunas = $santriSudahBayarIds->count(); 
        
        $persentasePembayaran = ($totalSantri > 0) 
            ? round(($jumlahLunas / $totalSantri) * 100, 2) 
            : 0;

        return view('admin.laporan.cetak', compact(
            'totalSantri', 
            'totalPendapatan', 
            'jumlahLunas', 
            'persentasePembayaran', 
            'santriBelumBayar', 
            'riwayatPembayaran',
            'jumlahBelumBayar',
            'namaBulanTarget'
        ));
    }

    public function cards()
    {
        $totalSantri = Santri::count();
        $totalPembayaran = Pembayaran::count();
        $totalBelumBayar = Santri::whereDoesntHave('pembayaran')->count();
        $totalNominal = Pembayaran::sum('jumlah_bayar');

        $pembayaranHariIni = Pembayaran::whereDate('tanggal_bayar', today())->count();
        $nominalHariIni = Pembayaran::whereDate('tanggal_bayar', today())->sum('jumlah_bayar');

        return view('admin.laporan.cards', compact(
            'totalSantri',
            'totalPembayaran',
            'totalBelumBayar',
            'totalNominal',
            'pembayaranHariIni',
            'nominalHariIni'
        ));
    }

    public function debug()
    {
        return response()->json([
            'total_santri' => Santri::count(),
            'total_pembayaran' => Pembayaran::count(),
            'sample_santri' => Santri::limit(3)->get(),
            'sample_pembayaran' => Pembayaran::with('santri')->limit(3)->get(),
            'santri_belum_bayar' => Santri::whereDoesntHave('pembayaran')->limit(3)->get(),
        ]);
    }
}
