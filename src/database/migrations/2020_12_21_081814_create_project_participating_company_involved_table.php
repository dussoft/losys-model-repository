<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectParticipatingCompanyInvolvedTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participating_company_involved', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participatingCompanyId')->unsigned();
            $table->integer('typeOfWorkId')->unsigned();
            $table->timestamps();
            $table->foreign('participatingCompanyId')->references('id')->on('project_participating_companies')->onDelete('cascade');;;
            $table->foreign('typeOfWorkId')->references('id')->on('type_of_works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_participating_company_involved');
    }
}
