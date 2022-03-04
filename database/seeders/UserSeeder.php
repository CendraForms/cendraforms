<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users = [
            [
                'name' => 'direccio',
                'email' => 'direccio@cendrassos.net',
                'password' => Hash::make('direccio'),
                'roles' =>  [ Role::firstWhere('name', 'direccio') ],
            ],
            [
                'name' => 'professor',
                'email' => 'professor@cendrassos.net',
                'password' => Hash::make('direccio'),
                'roles' =>  [ Role::firstWhere('name', 'professor') ],
            ],
            [
                'name' => 'alumne',
                'email' => 'alumne@cendrassos.net',
                'password' => Hash::make('alumne'),
                'roles' =>  [ Role::firstWhere('name', 'alumne') ],
            ],
        ];

        foreach ($users as $user) {
            $finalUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            $finalUser->roles()->attach($user['roles']);
        }
    }
}
