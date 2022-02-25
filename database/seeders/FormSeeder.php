<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    private $form = [
        ['name' => 'Enquesta Covid19', 'description' => 'Com ta ha afectat la coronita?', 'user_id' => 1],
        ['name' => 'Enquesta Pfizer', 'description' => 'Com ta ha afectat la pfizer?', 'user_id' => 1],
        ['name' => 'Enquesta Cendrassos', 'description' => 'Com ta ha afectat el cendrassos?', 'user_id' => 1]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->form as $i) {
            DB::table('form')->insert([
                'name' => $i["name"],
                'description' => $i["description"],
                'user_id' => $i["user_id"]
            ]);
        }
    }
}
