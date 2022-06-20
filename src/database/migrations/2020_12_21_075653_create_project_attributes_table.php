<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectAttributesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('subtype')->nullable();
            $table->boolean('view_web')->default(0);
            $table->boolean('view_datenblatt_extern')->default(0);
            $table->boolean('view_datenblatt_intern')->default(0);
            $table->timestamps();
            $table->integer('companyId')->unsigned();
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
        Schema::drop('project_attributes');
    }
}
