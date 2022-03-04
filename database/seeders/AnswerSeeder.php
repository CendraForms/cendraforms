<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database answer seeder.
     *
     * @return void
     */
    public function run()
    {
        Answer::create([
            'content' => 'Sí, has resolt els meus dubtes',
            'question_id' => 1,
            'user_id' => 1,
        ]);
    }
}
