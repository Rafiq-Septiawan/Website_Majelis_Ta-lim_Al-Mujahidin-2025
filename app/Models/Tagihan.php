<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $fillable = [
        'user_id',
        'santri_id',
        'bulan',
        'tahun',
        'nominal',
        'tanggal_tagihan',
        'jatuh_tempo',
        'status',
        'tanggal_bayar',
        'metode_bayar',
    ];

    protected $dates = [
        'tanggal_tagihan',
        'jatuh_tempo',
        'tanggal_bayar',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function santri()
    {
        return $this->belongsTo(\App\Models\Santri::class, 'santri_id', 'id');
    }
}