<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintPdfTempletesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_pdf_templetes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('cssFileName');
            $table->boolean('isDefault');
            $table->string('type');
            $table->integer('companyId')->unsigned();
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
        Schema::drop('print_pdf_templetes');
    }
}
