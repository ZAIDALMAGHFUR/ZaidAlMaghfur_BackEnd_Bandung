<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeders;
use Database\Seeders\SewaSeeders;
use Database\Seeders\MobilSeeders;
use Database\Seeders\UsersSeeders;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeders::class,
            UsersSeeders::class,
            MobilSeeders::class,
            SewaSeeders::class,
        ]);
    }
}
