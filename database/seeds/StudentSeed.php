<?php

use Illuminate\Database\Seeder;

class StudentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      DB::table("students")->insert([


        [
        
        "name"=>"Student Vitalis",
        "username"=>"student101",
        "email"=>"student@student.com",

        ]



     ]);
    }
}
