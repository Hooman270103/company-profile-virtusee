<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => 'password',
                'role' => 'Superadmin'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'role' => 'Admin'
            ],
        ];

        foreach ($data as $value) {
            $user = User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
            ]);

            $user->assignRole($value['role']);
        }
    }
}
