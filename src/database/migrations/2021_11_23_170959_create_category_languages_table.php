<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_languages', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title');

            $table->unsignedInteger('categoryId');
            $table->unsignedInteger('languageId');
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');;
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
        Schema::drop('category_languages');
    }
}
