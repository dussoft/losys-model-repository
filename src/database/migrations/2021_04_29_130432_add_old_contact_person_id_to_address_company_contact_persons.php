<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldContactPersonIdToAddressCompanyContactPersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address_company_contact_persons', function (Blueprint $table) {
            //
            $table->integer('old_contact_person_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_company_contact_persons', function (Blueprint $table) {
            //
        });
    }
}
