<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupServicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('groupId');
            $table->unsignedInteger('serviceId');
            $table->foreign('groupId')->references('id')->on('groups')->onDelete('cascade');;
            $table->foreign('serviceId')->references('id')->on('services')->onDelete('cascade');;
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
        Schema::drop('group_services');
    }
}
