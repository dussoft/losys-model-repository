<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefoTypeOfConstructionIdToProjectTypeOfContructions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_type_of_contructions', function (Blueprint $table) {
            //refo_type_of_construction_id
             $table->integer('refo_type_of_construction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_type_of_contructions', function (Blueprint $table) {
            //
        });
    }
}
