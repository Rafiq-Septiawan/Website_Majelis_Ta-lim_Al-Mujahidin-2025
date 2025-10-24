<?php

namespace App\Helpers;

use App\Models\Tagihan;
use Carbon\Carbon;

class TagihanHelper
{
    /**
     * Generate tagihan bulanan otomatis untuk user
     * Dipakai di berbagai controller supaya konsisten
     * 
     * @param int $userId
     * @return void
     */
    public static function generateTagihanBulanan($userId)
    {
        $tanggalSekarang = Carbon::now();
        $bulanSekarang = $tanggalSekarang->translatedFormat('F'); // Oktober, November, dll
        $tahunSekarang = $tanggalSekarang->year;

        // Cek apakah sudah ada tagihan untuk bulan ini
        $cekTagihan = Tagihan::where('user_id', $userId)
            ->where('bulan', $bulanSekarang)
            ->where('tahun', $tahunSekarang)
            ->exists();

        // Kalau belum ada, buat tagihan baru
        if (!$cekTagihan) {
            // PENTING: Tanggal tagihan harus tanggal 1 bulan ini
            $tanggalTagihan = Carbon::create($tahunSekarang, $tanggalSekarang->month, 1)->startOfDay();
            
            // Jatuh tempo 7 hari setelah tanggal tagihan (tanggal 8)
            $jatuhTempo = $tanggalTagihan->copy()->addDays(7);

            Tagihan::create([
                'user_id'         => $userId,
                'bulan'           => $bulanSekarang,
                'tahun'           => $tahunSekarang,
                'nominal'         => 50000,
                'tanggal_tagihan' => $tanggalTagihan,
                'jatuh_tempo'     => $jatuhTempo,
                'status'          => 'Belum Lunas',
            ]);
        }
    }
}