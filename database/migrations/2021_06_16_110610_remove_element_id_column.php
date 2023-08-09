<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveElementIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interactr_element_clicks', function (Blueprint $table) {
            $table->dropColumn('element_id');
        });

        Schema::table('interactr_element_impressions', function (Blueprint $table) {
            $table->dropColumn('element_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interactr_element_clicks', function (Blueprint $table) {
            $table->integer('element_id')->nullable();
        });

        Schema::table('interactr_element_impressions', function (Blueprint $table) {
            $table->integer('element_id')->nullable();
        });
    }
}
