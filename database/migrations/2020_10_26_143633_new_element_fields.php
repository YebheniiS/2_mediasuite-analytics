<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewElementFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('interactr_element_impressions', function (Blueprint $table) {
            $table->integer('interaction_id');
            $table->integer('modal_element_id');
        });
        Schema::table('interactr_element_clicks', function (Blueprint $table) {
            $table->integer('interaction_id');
            $table->integer('modal_element_id');
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
        Schema::table('interactr_element_impressions', function (Blueprint $table) {
            $table->dropColumn('interaction_id');
            $table->dropColumn('modal_element_id');
        });
        Schema::table('interactr_element_clicks', function (Blueprint $table) {
            $table->dropColumn('interaction_id');
            $table->dropColumn('modal_element_id');
        });
    }
}
