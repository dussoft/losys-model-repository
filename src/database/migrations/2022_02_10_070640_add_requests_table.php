<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
           
            $table->integer('userId');

$table->text('options')->nullable();
            $table->integer('projectId')->unsigned();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');

             
            $table->unsignedInteger('companyId');
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
            $table->string('created_by');
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
        //
    }
}
