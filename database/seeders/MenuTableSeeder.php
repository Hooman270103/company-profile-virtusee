<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
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
                'name' => 'Home',
                'slug' => 'home',
                'position' => 1,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
                'position' => 2,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Fitur',
                'slug' => 'fitur',
                'position' => 3,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Penerapan',
                'slug' => 'penerapan',
                'position' => 4,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Profil',
                'slug' => 'profil',
                'position' => 5,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Klien',
                'slug' => 'klien',
                'position' => 6,
                'status' => '2',
                'type' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($data as $value) {
            Menu::create([
                'name' => $value['name'],
                'slug' => $value['slug'],
                'position' => $value['position'],
                'status' => $value['status'],
                'type' =>  $value['type'],
                'parent_id' =>  $value['parent_id'] ?? null,
                'created_by' => $value['created_by'],
                'updated_by' => $value['updated_by'],
            ]);

        }
    }
}
