<?php

use Illuminate\Database\Seeder;

class ExcelLecturers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table("excelforlecturers")->insert([

        	[	
        		
                "name"=>"Lecturer Vitalis",
                "username"=>"2013/186880",
                "email"=>"lecturer@lecturer.com",
                      
        		
            ]

           

         ]);
                
    }
}
