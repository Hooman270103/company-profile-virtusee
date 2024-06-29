<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MenuTableSeeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\HeroesTableSeeder;
use Database\Seeders\SettingTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            SettingTableSeeder::class,
            MenuTableSeeder::class,
            IndoRegionSeeder::class,
            HeroesTableSeeder::class
        ]);
    }
}
