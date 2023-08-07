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
        Schema::create('sewa_mobil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->constrained('mobil')->nullable();
            $table->foreignId('id_users')->constrained('users')->nullable();
            $table->string('tanggal_sewa')->nullable();
            $table->string('tanggal_kembali')->nullable();
            $table->string('total_harga')->nullable();
            $table->enum('status_sewa', ['paid', 'failed', 'pending'])->nullable();
            $table->enum('status_pengembalian', ['belum dikembalikan', 'sudah dikembalikan'])->nullable();
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
        Schema::dropIfExists('sewa_mobil');
    }
};
