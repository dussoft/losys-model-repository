<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->string('country');

            $table->string('status')->default('Inactive');
        
            $table->string('alternativeName')->nullable();
            $table->string('mailBox')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('geolocationX')->nullable();
            $table->string('geolocationY')->nullable();
            $table->string('logoUrl')->nullable();

            $table->boolean('view_web')->default(0);
            $table->boolean('view_datenblatt_extern')->default(0);
            $table->boolean('view_datenblatt_intern')->default(0);
            
            $table->integer('companyId')->unsigned();
            $table->timestamps();
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
