<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransalationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transalations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->longText('value');
            $table->unsignedInteger('languageId');
            $table->foreign('languageId')->references('id')->on('languages')->onDelete('cascade');;
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
        Schema::drop('transalations');
    }
}
