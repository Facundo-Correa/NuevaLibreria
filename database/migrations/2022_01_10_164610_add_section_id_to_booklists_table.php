<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionIdToBooklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booklists', function (Blueprint $table) {
            $table->integer('booklists_sections_id')->unsigned()->nullable();
            $table->foreign('booklists_sections_id')->references('id')->on('booklists_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booklists', function (Blueprint $table) {
            $table->dropColumn('booklists_sections_id');
            $table->dropForeign('booklists_sections_id');
        });
    }
}
