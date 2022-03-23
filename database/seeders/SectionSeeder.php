<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database section seeder.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'name' => 'Nom secció 1',
            'form_id' => 1,
            'user_id' => 1,
        ]);

        Section::create([
            'name' => 'Nom secció 2',
            'form_id' => 2,
            'user_id' => 1,
        ]);

        Section::create([
            'name' => 'Nom secció 3',
            'form_id' => 3,
            'user_id' => 1,
        ]);
    }
}
