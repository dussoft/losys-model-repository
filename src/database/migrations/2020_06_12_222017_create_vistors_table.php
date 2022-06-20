<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVistorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address');
            $table->string('browser');
            $table->string('device');
            $table->string('current_location');
            $table->string('language');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('root');
            $table->string('https');
            $table->string('activity');
            $table->string('platform');
            $table->string('browser_version');
            $table->string('device_version');
            $table->string('lat');
            $table->string('lon');
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
        Schema::drop('vistors');
    }
}
