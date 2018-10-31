<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredcourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('student_name');
            $table->string('course_code');
            $table->string('course_title');
            $table->integer('unit');
            $table->string('semester');
            $table->string('level');
            $table->string('session');
            $table->string('approved');
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
        Schema::dropIfExists('registered_courses');
    }
}
