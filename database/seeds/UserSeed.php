<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table("users")->insert([

        	[
        		"id"=>1,
                "name"=>"Admin Vitalis",
                "username"=>"admin101",
        		"email"=>"admin@admin.com",
        		"password"=>bcrypt('admin101'),
        		"user"=>"admin"
            ],

            [
        		"id"=>2,
                "name"=>"Lecturer Vitalis",
                "username"=>"lecturer101",
        		"email"=>"lecturer@lecturer.com",
        		"password"=>bcrypt('lecturer101'),
        		"user"=>"lecturer"
            ],

            [
        		"id"=>3,
                "name"=>"Student Vitalis",
                "username"=>"student101",
        		"email"=>"student@student.com",
        		"password"=>bcrypt('student101'),
        		"user"=>"student"
            ],

         ]);
    }
}
