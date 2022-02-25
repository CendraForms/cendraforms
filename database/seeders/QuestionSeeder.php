<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    private $questions = [
        ['name' => 'Del 1 al 10 quina nota hem posaries?', 'content' => '', 'section_id' => 1],
        ['name' => 'He resolt correctament els teus subtes?', 'content' => '', 'section_id' => 1],
        ['name' => 'Creus que sóc un bon Professor?', 'content' => '', 'section_id' => 1]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->questions as $item) {
            DB::table('questions')->insert([
                'name' => $item["name"],
                'content' => $item["content"],
                'section_id' => $item["section_id"]
            ]);
        }
    }
}
