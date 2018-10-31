<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('name');
            $table->string('profile_pic')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('current_level');
            $table->string('level_admitted');
            $table->string('session_admitted');
            $table->string('entry_mode');
            $table->string('gender')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('country')->nullable();
            $table->string('lga')->nullable();
            $table->string('about')->nullable();
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
        Schema::dropIfExists('students');
    }
}
