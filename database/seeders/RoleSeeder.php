<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database role seeder.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'direccio'
        ]);

        Role::create([
            'name' => 'professor'
        ]);

        Role::create([
            'name' => 'alumne'
        ]);
    }
}
