<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FAQSeeder::class);
        $this->call(UserSeeder::class);
    }
}
