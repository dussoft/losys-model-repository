<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeOfBuildingLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_building_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
           
            $table->unsignedInteger('typeOfBuildingId');
            $table->unsignedInteger('languageId');
            $table->foreign('typeOfBuildingId')->references('id')->on('type_of_buildings')->onDelete('cascade');
            $table->foreign('languageId')->references('id')->on('languages')->onDelete('cascade');
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
        Schema::drop('type_of_building_languages');
    }
}
