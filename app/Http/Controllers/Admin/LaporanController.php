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

        // Jumlah tunggakan untuk bulan ini
        $totalTunggakan = max(0, $expectedThisMonth - $totalBulanIni);

        // Santri yang BELUM bayar bulan ini (termasuk yang belum pernah bayar)
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

        // Jumlah santri yang sudah bayar bulan ini
        $jumlahLunas = $totalSantri - $jumlahBelumBayar;

        // Persentase pembayaran bulan ini
        $persentasePembayaran = $totalSantri > 0
            ? round(($jumlahLunas / $totalSantri) * 100, 1)
            : 0;

        // Riwayat pembayaran terbaru (untuk tampilan)
        $riwayatPembayaran = Pembayaran::with('santri')
            ->orderBy('tanggal_bayar', 'desc')
            ->limit(50)
            ->get();

        // Total pendapatan kumulatif (opsional)
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


    // Laporan riwayat pembayaran //

    public function riwayat()
    {
        $riwayat = Pembayaran::with('santri')
            ->orderBy('tanggal_bayar', 'desc')
            ->paginate(50);

        return view('admin.laporan.riwayat', compact('riwayat'));
    }

    /**
     * Laporan santri yang belum bayar
     */
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

    /**
     * Halaman cetak laporan
     */
    public function cetak(Request $request)
    {
        $query = Pembayaran::with('santri');

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_bayar', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_bayar', '<=', $request->tanggal_akhir);
        }

        $riwayatPembayaran = $query->orderBy('tanggal_bayar', 'desc')->get();

        $totalPendapatan = $riwayatPembayaran->sum('jumlah_bayar');
        $totalSantri = Santri::count();

        return view('admin.laporan.cetak', compact(
            'riwayatPembayaran',
            'totalPendapatan',
            'totalSantri'
        ));
    }

    /**
     * Komponen kartu ringkasan laporan
     */
    public function cards()
    {
        $totalSantri = Santri::count();
        $totalPembayaran = Pembayaran::count();
        $totalBelumBayar = Santri::whereDoesntHave('pembayaran')->count();
        $totalNominal = Pembayaran::sum('jumlah_bayar');

        // Tambahan statistik
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

    /**
     * Debug API
     */
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

    /**
     * Filter laporan berdasarkan tanggal
     */
    public function filter(Request $request)
    {
        $query = Pembayaran::with('santri');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_bayar', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_bayar', $request->tahun);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $riwayatPembayaran = $query->orderBy('tanggal_bayar', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $riwayatPembayaran,
            'count' => $riwayatPembayaran->count()
        ]);
    }
}
