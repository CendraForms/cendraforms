<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forms')->insert([
            'name' => 'Enquesta Covid19',
            'description' => 'Com ta ha afectat la coronita?',
            'user_id' => 1,
        ]);

        DB::table('forms')->insert([
            'name' => 'Enquesta Pfizer',
            'description' => 'Com ta ha afectat la pfizer?',
            'user_id' => 1,
        ]);

        DB::table('forms')->insert([
            'name' => 'Enquesta Cendrassos',
            'description' => 'Com ta ha afectat el cendrassos?',
            'user_id' => 1,
        ]);
    }
}
