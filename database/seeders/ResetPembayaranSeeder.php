<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetPembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pembayarans')->truncate();
        DB::table('tagihans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Tabel "pembayarans dan tagihans" sudah dikosongkan dan ID di-reset ke 1.');
    }
}
