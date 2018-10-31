<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcelforresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excelforresults', function (Blueprint $table) {
            $table->string('name');
            $table->string('username')->primary();
            $table->string('course_code');
            $table->string('semester');
            $table->string('session');
            $table->string('level');
            $table->string('ca_score');
            $table->string('exam_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excelforresults');
    }
}
