<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    public function pembayaran() {
       return $this->hasMany(Pembayaran::class);
    }

    use HasFactory;

    protected $table = 'santris';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'wali',
        'alamat',
        'telepon',
    ];
}
