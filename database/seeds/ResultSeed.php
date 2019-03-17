<?php

use Illuminate\Database\Seeder;

class ResultSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("excelforresults")->insert([

        	[	
        		
                "name"=>"Student name",
                "username"=>"2013/000000",
                "course_code"=>"ECE001",
                "session"=>"2013/2014",
                "semester"=>"1",
                "level"=>"100",
                "ca_score"=>"30",
                "exam_score"=>"70"            
        		
            ]

           

         ]);
           
           
    }
}
