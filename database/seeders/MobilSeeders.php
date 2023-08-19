<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobilSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mobil::create([
            'nama_mobil' => 'Avanza',
            'merk_mobil' => 'Toyota',
            'plat_nomor' => 'B 12345 ABC',
            'warna_mobil' => 'Hitam',
            'tahun_keluaran' => '2019',
            'harga_sewa' => '200000',
            'gambar_mobils' => 'avanza.jpg',
            'status_mobil' => 'Tersedia',
        ]);

        Mobil::create([
            'nama_mobil' => 'Xenia',
            'merk_mobil' => 'Daihatsu',
            'plat_nomor' => 'B 123456 ABC',
            'warna_mobil' => 'Hitam',
            'tahun_keluaran' => '2019',
            'harga_sewa' => '200000',
            'gambar_mobils' => 'xenia.jpg',
            'status_mobil' => 'Tersedia',
        ]);

        Mobil::create([
            'nama_mobil' => 'Ertiga',
            'merk_mobil' => 'Suzuki',
            'plat_nomor' => 'B 1234567 ABC',
            'warna_mobil' => 'Hitam',
            'tahun_keluaran' => '2019',
            'harga_sewa' => '200000',
            'gambar_mobils' => 'ertiga.jpg',
            'status_mobil' => 'Tersedia',
        ]);

        Mobil::create([
            'nama_mobil' => 'Innova',
            'merk_mobil' => 'Toyota',
            'plat_nomor' => 'B 12345678 ABC',
            'warna_mobil' => 'Hitam',
            'tahun_keluaran' => '2019',
            'harga_sewa' => '200000',
            'gambar_mobils' => 'innova.jpg',
            'status_mobil' => 'Tersedia',
        ]);

        Mobil::create([
            'nama_mobil' => 'Alphard',
            'merk_mobil' => 'Toyota',
            'plat_nomor' => 'B 123456789 ABC',
            'warna_mobil' => 'Hitam',
            'tahun_keluaran' => '2019',
            'harga_sewa' => '200000',
            'gambar_mobils' => 'alphard.jpg',
            'status_mobil' => 'Tersedia',
        ]);
    }
}
