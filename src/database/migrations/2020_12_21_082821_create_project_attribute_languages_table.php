<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectAttributeLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_attribute_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectAttributeId')->unsigned();
            $table->integer('languageId')->unsigned();
            $table->longText('label');
            
            
            $table->timestamps();
            $table->foreign('projectAttributeId')->references('id')->on('project_attributes');
            $table->foreign('languageId')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_attribute_languages');
    }
}
