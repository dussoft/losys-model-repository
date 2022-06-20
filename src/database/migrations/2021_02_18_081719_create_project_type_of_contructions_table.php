<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTypeOfContructionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_type_of_contructions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('typeOfContructionId')->unsigned();
            $table->foreign('typeOfContructionId')->references('id')->on('type_of_constructions')->onDelete('cascade');
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
        Schema::drop('project_type_of_contructions');
    }
}
