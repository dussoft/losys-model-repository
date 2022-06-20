<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsNullableToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->string('alternativeName')->nullable()->change();
            $table->string('mailBox')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('zipcode')->nullable()->change();

            $table->string('phone')->nullable()->change();
            $table->string('fax')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('geolocationX')->nullable()->change();
            $table->string('geolocationY')->nullable()->change();
            $table->string('logoUrl')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
}
