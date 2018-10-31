<?php

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("admins")->insert([

        [
          
              "name"=>"Admin Vitalis",
              "username"=>"admin101",
              "email"=>"admin@admin.com",

          ]

       ]);
    }
}
