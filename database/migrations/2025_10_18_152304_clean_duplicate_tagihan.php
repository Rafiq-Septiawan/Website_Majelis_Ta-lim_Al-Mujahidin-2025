<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            DELETE t1 FROM tagihans t1
            INNER JOIN tagihans t2 
            WHERE t1.id > t2.id 
            AND t1.user_id = t2.user_id 
            AND t1.bulan = t2.bulan 
            AND t1.tahun = t2.tahun
        ");
    }

    public function down()
    {

    }
};