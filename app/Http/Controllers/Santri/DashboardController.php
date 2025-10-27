<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\Santri;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->first();

        if (!$santri) {
            return view('santri.dashboard')->with('error', 'Data santri tidak ditemukan.');
        }

        $bulanSekarang = now()->month;
        $tahunSekarang = now()->year;

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei',
            6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober',
            11 => 'November', 12 => 'Desember'
        ];

        $bulanText = $namaBulan[$bulanSekarang];

        $tagihanAda = Tagihan::where('santri_id', $santri->id)
            ->where('bulan', $bulanText)
            ->where('tahun', $tahunSekarang)
            ->exists();

        if (!$tagihanAda) {
            Tagihan::create([
                'santri_id'       => $santri->id,
                'user_id'         => $user->id,
                'bulan'           => $bulanText,
                'tahun'           => $tahunSekarang,
                'nominal'         => 50000,
                'tanggal_tagihan' => now(),
                'jatuh_tempo'     => now()->addDays(7),
                'status'          => 'Belum Lunas',
            ]);
        }

        $totalTagihanAktif = Tagihan::where('santri_id', $santri->id)
            ->where('status', 'Belum Lunas')
            ->sum('nominal');

        $jumlahTagihanBelumLunas = Tagihan::where('santri_id', $santri->id)
            ->where('status', 'Belum Lunas')
            ->count();

        $totalDibayar = Pembayaran::where('santri_id', $santri->id)
            ->where('status', 'Lunas')
            ->sum('jumlah_bayar');

        $jumlahPembayaranSelesai = Pembayaran::where('santri_id', $santri->id)
            ->where('status', 'Lunas')
            ->count();

        $tagihanTerdekat = Tagihan::where('santri_id', $santri->id)
            ->where('status', 'Belum Lunas')
            ->whereNotNull('jatuh_tempo')
            ->orderBy('jatuh_tempo', 'asc')
            ->first();

        $riwayatPembayaran = Pembayaran::where('santri_id', $santri->id)
            ->where('status', 'Lunas')
            ->orderByDesc('tanggal_bayar')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $item->tanggal_bayar_formatted = $item->tanggal_bayar
                    ? Carbon::parse($item->tanggal_bayar)->translatedFormat('d F Y')
                    : '-';

                $item->jumlah_bayar_formatted = 'Rp ' . number_format($item->jumlah_bayar ?? 0, 0, ',', '.');

                $item->status_badge = '<span class="badge bg-success">Lunas</span>';
                $item->metode_bayar = $item->metode_bayar ?? 'Tunai';

                if ($item->metode_bayar === 'Transfer Bank') {
                    $item->metode_icon = '<i class="bi bi-bank"></i>';
                } elseif ($item->metode_bayar === 'Tunai') {
                    $item->metode_icon = '<i class="bi bi-cash-coin"></i>';
                } elseif ($item->metode_bayar === 'E-Wallet') {
                    $item->metode_icon = '<i class="bi bi-wallet2"></i>';
                } else {
                    $item->metode_icon = '<i class="bi bi-credit-card"></i>';
                }

                return $item;
            });

        return view('santri.dashboard', compact(
            'santri',
            'totalTagihanAktif',
            'jumlahTagihanBelumLunas',
            'totalDibayar',
            'jumlahPembayaranSelesai',
            'tagihanTerdekat',
            'riwayatPembayaran',
        ));
    }

    private function getChartData($santriId)
    {
        $bulanIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $data = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan = $date->month;
            $tahun = $date->year;

            $total = Pembayaran::where('santri_id', $santriId)
                ->where('status', 'Lunas')
                ->whereYear('tanggal_bayar', $tahun)
                ->whereMonth('tanggal_bayar', $bulan)
                ->sum('jumlah_bayar');

            $labels[] = $bulanIndo[$bulan];
            $data[] = $total;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    public function handleCallback(Request $request)
    {
        $transactionId = $request->input('order_id');
        $statusPembayaran = $request->input('transaction_status');

        if (in_array($statusPembayaran, ['settlement', 'capture'])) {
            $pembayaran = Pembayaran::where('transaction_id', $transactionId)->first();
            
            if ($pembayaran && $pembayaran->status != 'Lunas') {
                $pembayaran->status = 'Lunas';
                $pembayaran->tanggal_bayar = Carbon::now();
                $pembayaran->save();

                $tagihan = Tagihan::find($pembayaran->tagihan_id);
                if ($tagihan) {
                    $tagihan->status = 'Lunas';
                    $tagihan->tanggal_bayar = Carbon::now();
                    $tagihan->save();
                }
            }
        }

        return response('OK', 200);
    }
}
