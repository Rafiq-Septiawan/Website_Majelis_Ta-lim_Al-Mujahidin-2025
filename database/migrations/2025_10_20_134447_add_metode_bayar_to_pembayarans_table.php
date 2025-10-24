<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
        {
            Schema::table('pembayarans', function (Blueprint $table) {
                $table->string('metode_bayar')->nullable()->after('jumlah_bayar');
                $table->string('bukti_transfer')->nullable()->after('metode_bayar');
            });
        }

    public function down()
        {
            Schema::table('pembayarans', function (Blueprint $table) {
                $table->dropColumn(['metode_bayar', 'bukti_transfer']);
            });
        }
};
