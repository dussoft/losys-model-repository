<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefoTypeOfWorkIdToProjectTypeOfWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_type_of_works', function (Blueprint $table) {
            //refo_type_of_work_id
             $table->integer('refo_type_of_work_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_type_of_works', function (Blueprint $table) {
            //
        });
    }
}
