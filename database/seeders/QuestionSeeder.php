<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'name' => 'Del 1 al 10 quina nota em posaries?',
            'content' => '{}',
            'section_id' => 1,
        ]);

        DB::table('questions')->insert([
            'name' => 'He resolt correctament els teus subtes?',
            'content' => '{}',
            'section_id' => 2,
        ]);

        DB::table('questions')->insert([
            'name' => 'Creus que sóc un bon Professor?',
            'content' => '{}',
            'section_id' => 3,
        ]);
    }
}
