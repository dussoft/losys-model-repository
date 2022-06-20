<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectPropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->integer('projectAttributeId')->unsigned();
  
            $table->longText('value')->nullable();
            
            $table->timestamps();
            $table->foreign('projectId')->references('id')->on('projects');
            $table->foreign('projectAttributeId')->references('id')->on('project_attributes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_properties');
    }
}
