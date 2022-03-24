<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database user seeder.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'direccio',
                'email' => 'direccio@cendrassos.net',
                'roles' => [Role::firstWhere('name', 'direccio')->id],
            ],
            [
                'name' => 'professor',
                'email' => 'professor@cendrassos.net',
                'roles' => [Role::firstWhere('name', 'professor')->id],
            ],
            [
                'name' => 'alumne',
                'email' => 'alumne@cendrassos.net',
                'roles' => [Role::firstWhere('name', 'alumne')->id],
            ],
            [
                'name' => 'alumne2',
                'email' => 'alumne2@cendrassos.net',
                'roles' => [Role::firstWhere('name', 'alumne')->id],
            ],
        ];

        foreach ($users as $user) {
            $finalUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
            ]);

            $finalUser->roles()->attach($user['roles']);
        }
    }
}
