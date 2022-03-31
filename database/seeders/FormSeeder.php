<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database form seeder.
     *
     * @return void
     */
    public function run()
    {
        Form::create([
            'name' => 'Enquesta Covid19',
            'description' => 'Com t\'ha afectat la coronita?',
            'user_id' => 1,
        ]);

        Form::create([
            'name' => 'Enquesta Pfizer',
            'description' => 'Com t\'ha afectat la pfizer?',
            'user_id' => 1,
        ]);

        Form::create([
            'name' => 'Enquesta Cendrassos',
            'description' => 'Com t\'ha afectat el cendrassos?',
            'user_id' => 1,
            'published' => true,
            'anonymized' => true,
        ]);
    }
}
