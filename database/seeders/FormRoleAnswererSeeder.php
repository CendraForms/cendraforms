<?php

namespace Database\Seeders;

use App\Models\FormRoleAnswerer;
use Illuminate\Database\Seeder;

class FormRoleAnswererSeeder extends Seeder
{
    /**
     * Run the database form seeder.
     *
     * @return void
     */
    public function run()
    {
        FormRoleAnswerer::create([
            'form_id' => 1,
            'role_id' => 2,
        ]);

        FormRoleAnswerer::create([
            'form_id' => 2,
            'role_id' => 2,
        ]);

        FormRoleAnswerer::create([
            'form_id' => 3,
            'role_id' => 2,
        ]);

        FormRoleAnswerer::create([
            'form_id' => 1,
            'role_id' => 3,
        ]);

        FormRoleAnswerer::create([
            'form_id' => 2,
            'role_id' => 3,
        ]);

        FormRoleAnswerer::create([
            'form_id' => 3,
            'role_id' => 3,
        ]);
    }
}
