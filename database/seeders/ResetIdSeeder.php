<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetIdSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('santris')->truncate();

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE santris AUTO_INCREMENT = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
