<?php

namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->count() == 0)
            $this->seedRoles();


        $superAdmin = DB::table('roles')->where("name","Super Admin")->first();

        User::create([
            "name" => "Super",
            "user_name" => "Super",
            "email" => "super@gmail.com",
            "password" => bcrypt("password"),
            "role_id" => $superAdmin->id,
         ]);

    }

    public function seedRoles(){

        $time = Carbon::parse('UTC')->now();

        $roles = [
            [
                'name'=>'Super Admin',
                'created_at'=>$time,
                'updated_at'=>$time
            ],

            [
                'name'=>'Admin',
                'created_at'=>$time,
                'updated_at'=>$time
            ]
        ];

        DB::table('roles')->insert($roles);
    }
    
}
