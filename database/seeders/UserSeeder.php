<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'usuari1',
            'email' => 'usuari1@mail.com',
            'password' => Hash::make('passwdUltraSegura'),
        ]);

        DB::table('users')->insert([
            'name' => 'usuari2',
            'email' => 'usuari2@mail.com',
            'password' => Hash::make('passwdUltraSegura'),
        ]);

        DB::table('users')->insert([
            'name' => 'usuari3',
            'email' => 'usuari3@mail.com',
            'password' => Hash::make('passwdUltraSegura'),
        ]);
    }
}
