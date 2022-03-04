<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'form_id' => 1,
            'user_id' => 1,
        ]);
        
        DB::table('sections')->insert([
            'form_id' => 2,
            'user_id' => 1,
        ]);

        DB::table('sections')->insert([
            'form_id' => 3,
            'user_id' => 1,
        ]);
    }
}
