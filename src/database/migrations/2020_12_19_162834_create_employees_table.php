<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateemployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('mobile');
            $table->string('email');
            $table->string('language');
            $table->string('gender');
            $table->date('yearOfBirth');
            $table->string('function');
            $table->string('education');
            $table->string('skills');
            $table->string('pictureUrl');
            
            $table->bigInteger('userId')->unsigned();
            $table->unsignedInteger('companyId');
         
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::drop('employees');
    }
}
