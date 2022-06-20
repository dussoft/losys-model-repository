<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewOptionToProjectParticipatingCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_participating_companies', function (Blueprint $table) {
            $table->boolean('view_web')->default(0);
            $table->boolean('view_datenblatt_extern')->default(0);
            $table->boolean('view_datenblatt_intern')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_participating_companies', function (Blueprint $table) {
            //
        });
    }
}
