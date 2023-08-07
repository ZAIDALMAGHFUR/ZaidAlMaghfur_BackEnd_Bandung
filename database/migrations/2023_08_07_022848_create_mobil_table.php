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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('merk_mobil');
            $table->string('plat_nomor');
            $table->string('warna_mobil');
            $table->string('tahun_keluaran');
            $table->string('harga_sewa');
            $table->string('gambar_mobils');
            $table->enum('status_mobil', ['Tersedia', 'Di Sewa'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil');
    }
};
