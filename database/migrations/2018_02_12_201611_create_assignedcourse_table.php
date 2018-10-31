<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedcourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lecturer_id');
            $table->string('lecturer_name');
            $table->string('course_code');
            $table->string('session');
            $table->string('level');
            $table->string('semester');
            $table->string('department');
            $table->string('coordinator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigned_courses');
    }
}
