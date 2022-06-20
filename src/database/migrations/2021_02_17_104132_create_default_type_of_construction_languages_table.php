<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultTypeOfConstructionLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_type_of_construction_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('typeOfConstrationId');
            $table->unsignedInteger('languageId');
            
            $table->foreign('typeOfConstrationId')->references('id')->on('default_type_of_constructions')->onDelete('cascade');
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
        Schema::drop('default_type_of_construction_languages');
    }
}
