<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            ReferenceSeeder::class,
            SettingSeeder::class,
            EmployeeSeeder::class,
            OvertimeSeeder::class,
        ]);
        // User::factory(10)->create();
    }
}
