<?php

namespace Database\Seeders;

use App\Models\Dog;
use App\Models\User;
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
        User::factory(200)->create();
        // $this->call(DogSeeder::class);

    }
}