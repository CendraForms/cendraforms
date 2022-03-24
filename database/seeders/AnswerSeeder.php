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
            'content' => 'Et posaria un 10',
            'question_id' => 1,
            'user_id' => 1,
        ]);

        Answer::create([
            'content' => 'Et posaria un 5',
            'question_id' => 1,
            'user_id' => 2,
        ]);

        Answer::create([
            'content' => 'Sí, has resolt els meus dubtes',
            'question_id' => 2,
            'user_id' => 1,
        ]);

        Answer::create([
            'content' => 'No, no has resolt els meus dubtes',
            'question_id' => 2,
            'user_id' => 2,
        ]);

        Answer::create([
            'content' => 'Sí, ets un bon professor',
            'question_id' => 3,
            'user_id' => 2,
        ]);

        Answer::create([
            'content' => 'No, no ets un bon professor',
            'question_id' => 3,
            'user_id' => 1,
        ]);
    }
}
