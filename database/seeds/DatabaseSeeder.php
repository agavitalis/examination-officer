<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UserTableSeeder::class);
        $this->call(UserSeed::class);
        $this->call(SemesterSeed::class);
        $this->call(ExcelStudents::class);
        $this->call(ExcelLecturers::class);
        $this->call(ResultSeed::class);
        $this->call(LecturerSeed::class);
        $this->call(StudentSeed::class);
        $this->call(AdminSeed::class);
    }
}
