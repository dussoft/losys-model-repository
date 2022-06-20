<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('name');
            $table->string('alternativeName');
            $table->string('mailBox');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->string('country');

            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->string('geolocationX');
            $table->string('geolocationY');
            $table->string('logoUrl');
        
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
        Schema::drop('companies');
    }
}
