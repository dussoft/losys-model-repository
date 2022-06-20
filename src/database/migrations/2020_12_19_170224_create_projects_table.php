<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->string('geolocationX');
            $table->string('geolocationY');
            $table->string('status');
            $table->string('title');
            $table->integer('yearOfCompletion')->nullable();
            $table->longText('description')->nullable();
            $table->integer('companyId')->unsigned();
            $table->string('projectWebsite')->nullable();
            $table->boolean('visibilityOption')->default(0);
            $table->string('country')->nullable();
            $table->timestamps();
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
