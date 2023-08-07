<?php

namespace Database\Seeders;

use App\Models\Sewa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SewaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sewa::create([
            'mobil_id' => 1,
            'id_users' => 2,
            'tanggal_sewa' => '2021-01-01',
            'tanggal_kembali' => '2021-01-02',
            'total_harga' => 100000,
            'status_sewa' => 'paid',
            'status_pengembalian' => 'sudah dikembalikan',
        ]);

        Sewa::create([
            'mobil_id' => 2,
            'id_users' => 2,
            'tanggal_sewa' => '2021-01-01',
            'tanggal_kembali' => '2021-01-02',
            'total_harga' => 100000,
            'status_sewa' => 'paid',
            'status_pengembalian' => 'sudah dikembalikan',
        ]);

        Sewa::create([
            'mobil_id' => 3,
            'id_users' => 2,
            'tanggal_sewa' => '2021-01-01',
            'tanggal_kembali' => '2021-01-02',
            'total_harga' => 100000,
            'status_sewa' => 'paid',
            'status_pengembalian' => 'sudah dikembalikan',
        ]);

        Sewa::create([
            'mobil_id' => 4,
            'id_users' => 2,
            'tanggal_sewa' => '2021-01-01',
            'tanggal_kembali' => '2021-01-02',
            'total_harga' => 100000,
            'status_sewa' => 'paid',
            'status_pengembalian' => 'sudah dikembalikan',
        ]);
    }
}
