<?php

use Illuminate\Database\Seeder;

class LecturerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("lecturers")->insert([


          [
          
          "name"=>"Lecturer Vitalis",
          "username"=>"lecturer101",
          "email"=>"lecturer@lecturer.com",

          ],



       ]);
    }
}
