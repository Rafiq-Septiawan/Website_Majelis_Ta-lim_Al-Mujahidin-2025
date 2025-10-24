<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    public $timestamps = true;

    protected $fillable = [
        'santri_id',
        'user_id',
        'tagihan_id',
        'nama_santri',
        'bulan',
        'jumlah_bayar',
        'metode_bayar',
        'bukti_transfer',
        'tanggal_bayar',
        'status',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }
}