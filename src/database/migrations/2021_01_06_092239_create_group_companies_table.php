<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCompaniesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('groupId')->unsigned();
            $table->integer('companyId')->unsigned();
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('groupId')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::drop('group_companies');
    }
}
