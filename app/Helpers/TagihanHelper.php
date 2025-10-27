<?php

namespace App\Helpers;

use App\Models\Tagihan;
use Carbon\Carbon;

class TagihanHelper
{
    public static function generateTagihanBulanan($userId)
    {
        $tanggalSekarang = Carbon::now();
        $bulanSekarang = $tanggalSekarang->translatedFormat('F');
        $tahunSekarang = $tanggalSekarang->year;

        $cekTagihan = Tagihan::where('user_id', $userId)
            ->where('bulan', $bulanSekarang)
            ->where('tahun', $tahunSekarang)
            ->exists();

        if (!$cekTagihan) {
            $tanggalTagihan = Carbon::create($tahunSekarang, $tanggalSekarang->month, 1)->startOfDay();
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