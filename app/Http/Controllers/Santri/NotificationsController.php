<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran; 
use App\Models\Tagihan; // <--- PASTIKAN INI DI-IMPORT
use Carbon\Carbon;
use App\Models\User; 

class NotificationsController extends Controller
{
    public function index()
    {
        return view('santri.notifications');
    }

    public function fetchNotifications(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->santri) { // Cek user dan relasi santri
            return response()->json([], 401);
        }
        
        $santri = $user->santri; // Asumsi ada relasi user->santri
        $notifications = [];
        $tanggalSekarang = Carbon::now();
        
        // =======================================================
        // 1. Notifikasi SELAMAT DATANG (Muncul 7 hari setelah registrasi)
        // =======================================================
        $tanggalRegistrasi = Carbon::parse($user->created_at);
        if ($tanggalRegistrasi->diffInDays($tanggalSekarang) <= 7) { 
            $notifications[] = [
                'type' => 'SELAMAT_DATANG', 
                'pesan' => "Selamat datang, **{$user->name}**! Akun Anda telah berhasil terdaftar dan siap digunakan. Silakan cek menu Pembayaran untuk detail tagihan SPP Anda.",
                'created_at' => $user->created_at->toISOString(),
            ];
        }

        // =======================================================
        // 2. Notifikasi Konfirmasi Berhasil (HIJAU) - Diperbarui
        // =======================================================
        $konfirmasiBerhasil = Pembayaran::where('user_id', $user->id)
            ->where('status', 1) 
            ->orderBy('updated_at', 'desc') 
            ->limit(5)
            ->get();
        
        foreach ($konfirmasiBerhasil as $pembayaran) {
            $metodeBayar = $pembayaran->metode_bayar ?? 'Tunai/Bank Transfer';
            
            $notifications[] = [
                'type' => 'KONFIRMASI_BERHASIL',
                'bulan' => $pembayaran->bulan, 
                'jumlah_bayar' => $pembayaran->jumlah_bayar, 
                'metode_bayar' => $metodeBayar, 
                'created_at' => $pembayaran->updated_at->toISOString(),
            ];
        }

        // =======================================================
        // 3. Notifikasi Peringatan Jatuh Tempo (MERAH MUDA) - KOREKSI LOGIKA
        // =======================================================
        $tanggalBatasJatuhTempo = Carbon::now()->addDays(7);

        // Langsung query ke Tagihan dengan status 0
        $tagihanBelumLunas = Tagihan::where('user_id', $user->id) 
            ->where('status', 0) // KOREKSI: Status Tagihan Belum Lunas = 0
            ->whereNotNull('jatuh_tempo')
            ->whereBetween('jatuh_tempo', [Carbon::today(), $tanggalBatasJatuhTempo])
            ->get();

        foreach ($tagihanBelumLunas as $tagihan) {
            $tanggalJatuhTempo = Carbon::parse($tagihan->jatuh_tempo); 
            $hariSisa = $tanggalSekarang->diffInDays($tanggalJatuhTempo, false); // false untuk hitung mundur

            if ($hariSisa >= 0 && $hariSisa <= 7) { 
                $notifications[] = [
                    'type' => 'JATUH_TEMPO',
                    'bulan' => $tagihan->bulan,
                    'jumlah_bayar' => $tagihan->nominal, // Ambil nominal dari Tagihan
                    'hari_sisa' => $hariSisa,
                    'tanggal_jatuh_tempo' => $tanggalJatuhTempo->format('d M Y'), 
                    'created_at' => $tagihan->created_at->toISOString(),
                ];
            }
        }
        
        // =======================================================
        // 4. Notifikasi Tagihan Lewat Jatuh Tempo (MERAH TUA) - KOREKSI LOGIKA
        // =======================================================
        // Langsung query ke Tagihan dengan status 0
        $tagihanLewatJatuhTempo = Tagihan::where('user_id', $user->id)
            ->where('status', 0) // KOREKSI: Status Tagihan Belum Lunas = 0
            ->whereNotNull('jatuh_tempo')
            ->where('jatuh_tempo', '<', Carbon::today())
            ->get();
            
        foreach ($tagihanLewatJatuhTempo as $tagihan) {
            $tanggalJatuhTempo = Carbon::parse($tagihan->jatuh_tempo);
            
            $hariTerlambat = $tanggalJatuhTempo->diffInDays(Carbon::today());
            
            $notifications[] = [
                'type' => 'LEWAT_JATUH_TEMPO',
                'bulan' => $tagihan->bulan,
                'jumlah_bayar' => $tagihan->nominal, // Ambil nominal dari Tagihan
                'hari_terlambat' => $hariTerlambat,
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo->format('d M Y'),
                'created_at' => Carbon::now()->toISOString(), 
            ];
        }

        $sortedNotifications = collect($notifications)->sortByDesc('created_at')->values()->all();

        return response()->json($sortedNotifications);
    }
}