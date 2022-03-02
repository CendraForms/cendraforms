<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    private $answers = [
        ['content' => 'Poc'],
        ['content' => 'Normal'],
        ['content' => 'Molt']
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->answers as $item) {
            DB::table('answer')->insert([
                'content' => $item["content"],
                'question_id' => "1",
                'user_id' => "1"
            ]);
        }
    }
}
