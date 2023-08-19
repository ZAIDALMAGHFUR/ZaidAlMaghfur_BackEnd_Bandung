<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        'name' => 'admin',
        ]);
        Role::create([
        'name' => 'agent',
        ]);
        Role::create([
        'name' => 'user',
        ]);
    }
}
