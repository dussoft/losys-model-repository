<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectParticipatingCompaniesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_participating_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->integer('addressId')->unsigned();
            $table->timestamps();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');;
            $table->foreign('addressId')->references('id')->on('addresses')->onDelete('cascade');;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_participating_companies');
    }
}
