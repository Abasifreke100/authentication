<?php

namespace Database\Seeders;
use App\Models\User;

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
            "name"=>"John Doe",
            "email"=>"johndoe@gmail.com",
            "password"=>bcrypt("password"),
        ]);

        User::create([
            "name"=>"Jane Doe",
            "email"=>"janedoe@gmail.com",
            "password"=>bcrypt("password"),
        ]);

        User::create([
            "name"=>"Kane Doe",
            "email"=>"kanedoe@gmail.com",
            "password"=>bcrypt("password"),
        ]);
    }
}
