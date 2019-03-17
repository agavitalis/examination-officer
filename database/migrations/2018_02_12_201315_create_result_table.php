<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('course_title');
            $table->string('course_code');
            $table->string('session');
            $table->string('level');
            $table->string('semester');
            $table->string('ca_score');
            $table->string('exam_score');
            $table->string('total_score');
            $table->string('grade');
            $table->integer('unit_load');
            $table->string('point');
            $table->string('coordinator');
            $table->string('uploaded_by');
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
        Schema::dropIfExists('results');
    }
}
