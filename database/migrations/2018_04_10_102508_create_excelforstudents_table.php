<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcelforstudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excelforstudents', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('current_level');            
            $table->string('level_admitted');
            $table->string('session_admitted');
            $table->string('entry_mode');
        
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excelforstudents');
    }
}
