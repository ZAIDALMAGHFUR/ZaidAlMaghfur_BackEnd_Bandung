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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->nullable();
            $table->string('no_nik');
            $table->string('foto_ktp');
            $table->string('no_sim');
            $table->string('tgl_berakhir_sim');
            $table->string('foto_sim');
            $table->enum('jenis_sim', ['A', 'C'])->nullable();
            $table->string('no_plat_kendaraan');
            $table->enum('jenis_kendaraan', ['mobil', 'motor'])->nullable();
            $table->string('foto_stnk');
            $table->enum('status_berkas', ['belum diverifikasi', 'sudah diverifikasi'])->nullable();
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
        Schema::dropIfExists('berkas');
    }
};
