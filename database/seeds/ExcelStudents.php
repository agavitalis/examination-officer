<?php

use Illuminate\Database\Seeder;

class ExcelStudents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("excelforstudents")->insert([

        	[	
        		
               "name"=>"Student Vitalis",
                "username"=>"2013/186880",
                "email"=>"student@student.com",
                "session_admitted"=>"100",
                "current_level"=>"100",
                "level_admitted"=>"100",
                "entry_mode"=>"utme"
                
                
        		
            ],
            [	
        		
               "name"=>"Student Vitalis2",
                "username"=>"2013/186881",
                "email"=>"student@student2.com",
                "session_admitted"=>"100",
                "current_level"=>"100",
                "level_admitted"=>"100",
                "entry_mode"=>"direct_entry"
                
                
        		
            ],

           

         ]);
    }
}
