<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLangauagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_langauages', function (Blueprint $table) {
            $table->id();
            $table->string('function');
            $table->string('education');
            $table->string('skills');
            $table->string('created_by');
            $table->unsignedInteger('languageId');
            $table->integer('employeId');
            $table->foreign('languageId')->references('id')->on('languages')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('employee_langauages');
    }
}
