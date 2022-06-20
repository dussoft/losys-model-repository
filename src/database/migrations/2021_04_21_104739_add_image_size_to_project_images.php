<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageSizeToProjectImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('extralarge_image')->nullable();
            $table->string('large_image')->nullable();
            $table->string('medium_image')->nullable();
            $table->string('small_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_images', function (Blueprint $table) {
            //
        });
    }
}
