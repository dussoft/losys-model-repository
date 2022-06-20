<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectContactPersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_contact_persons', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('projectId')->unsigned();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');

            $table->integer('contactPersonId')->unsigned();
            $table->foreign('contactPersonId')->references('id')->on('address_company_contact_persons')->onDelete('cascade');
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
        Schema::drop('project_contact_persons');
    }
}
