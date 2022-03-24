<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database question seeder.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'name' => 'Del 1 al 10 quina nota em posaries?',
            'content' => '{}',
            'section_id' => 1,
        ]);

        Question::create([
            'name' => 'He resolt correctament els teus subtes?',
            'content' => '{}',
            'section_id' => 2,
        ]);

        Question::create([
            'name' => 'Creus que sóc un bon Professor?',
            'content' => '{}',
            'section_id' => 3,
        ]);
    }
}
