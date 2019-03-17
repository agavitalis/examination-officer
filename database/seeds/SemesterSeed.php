<?php

use Illuminate\Database\Seeder;

class SemesterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table("semesters")->insert([

        	[	
        		
                "semester_name"=>"First Semester",
                "semester_value"=>"1",
        		
            ],

            [	
        		
                "semester_name"=>"Second Semester",
                "semester_value"=>"2",
                
            ],

           

         ]);
    }
}
