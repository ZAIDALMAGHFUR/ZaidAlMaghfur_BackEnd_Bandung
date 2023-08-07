<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'zaid',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Raya Cikarang',
            'no_sim' => '1234567890',
            'roles_id' => 1,
            'email_verified_at' => now(), // this is for email verification
            'password' => bcrypt('password'),
        ]);

        User::create([
            'first_name' => 'user',
            'last_name' => 'zaid',
            'email' => 'user@gmail.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Raya Cikarang',
            'no_sim' => '1234567890',
            'roles_id' => 2,
            'email_verified_at' => now(), // this is for email verification
            'password' => bcrypt('password'),
        ]);
    }
}
