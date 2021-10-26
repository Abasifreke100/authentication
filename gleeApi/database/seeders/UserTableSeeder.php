<?php

namespace Database\Seeders;

use Glee\Modules\Auth\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"admin",
            "email"=>"admin@gmail.com",
            "password"=>"password"
        ]);
    }
}
