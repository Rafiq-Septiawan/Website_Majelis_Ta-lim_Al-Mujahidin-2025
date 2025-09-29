<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    // nama tabel (opsional, karena defaultnya plural dari model = santris)
    protected $table = 'santris';

    // field yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'wali',
        'alamat',
        'telepon',
    ];
}
