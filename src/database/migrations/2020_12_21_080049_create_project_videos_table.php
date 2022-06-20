<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectVideosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->longText('embbedIframe');
            $table->string('isMainVideo');
            $table->timestamps();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_videos');
    }
}
