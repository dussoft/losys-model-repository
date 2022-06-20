<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToIframeTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iframe_templates', function (Blueprint $table) {
            $table->string('cssFileName')->nullable();
            $table->boolean('isMapVisible')->default(1);
            $table->boolean('isSearchBoxVisible')->default(1);
            $table->boolean('isPdfVisible')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iframe_templates', function (Blueprint $table) {
            //
        });
    }
}
