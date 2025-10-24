<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santris';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'wali',
        'alamat',
        'telepon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'santri_id');
    }
}