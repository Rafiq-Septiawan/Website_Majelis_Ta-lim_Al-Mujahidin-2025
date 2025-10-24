<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('bulan'); // contoh: Januari, February, atau format angka sesuai kebutuhan
            $table->integer('tahun');
            $table->integer('nominal')->default(50000);
            $table->date('tanggal_tagihan')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->enum('status', ['Belum Lunas','Lunas'])->default('Belum Lunas');
            $table->timestamp('tanggal_bayar')->nullable();
            $table->string('metode_bayar')->nullable();
            $table->timestamps();

            // foreign key (jika users.id memang ada)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihans');
    }
};
