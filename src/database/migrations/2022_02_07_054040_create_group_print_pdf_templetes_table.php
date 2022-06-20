<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPrintPdfTempletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_print_pdf_templetes', function (Blueprint $table) {
            $table->id();
           
            $table->string('title');
            $table->string('cssFileName');
            $table->string('type');
            $table->string('companyBladePdfGenerator');
            $table->boolean('isDefault')->default(0);

            $table->string('created_by');
            $table->unsignedInteger('groupId');
            $table->foreign('groupId')->references('id')->on('groups')->onDelete('cascade');;
            $table->softDeletes();
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
        Schema::dropIfExists('group_print_pdf_templetes');
    }
}
