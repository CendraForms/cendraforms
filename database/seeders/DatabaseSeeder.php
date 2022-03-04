<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FormSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AnswerSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\QuestionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FormSeeder::class,
            SectionSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
