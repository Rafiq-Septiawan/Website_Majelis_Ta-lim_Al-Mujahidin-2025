<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',      // ✅ tambahkan ini
        'nama_santri',
        'bulan',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
    ];

    // ✅ Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}