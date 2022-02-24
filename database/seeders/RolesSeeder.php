<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'direccio'
        ]);

        DB::table('roles')->insert([
            'name' => 'professor'
        ]);

        DB::table('roles')->insert([
            'name' => 'alumne'
        ]);
    }
}
