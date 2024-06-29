<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Superadmin', 'Admin'] as $key => $value) {
            Role::create([
                'name' => $value
            ]);
        }
    }
}
