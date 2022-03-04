<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            'content' => 'Sí, has resolt els meus dubtes',
            'question_id' => 1,
            'user_id' => 1,
        ]);
    }
}
