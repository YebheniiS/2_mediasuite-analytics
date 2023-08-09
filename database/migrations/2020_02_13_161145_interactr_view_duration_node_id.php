<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InteractrViewDurationNodeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('interactr_node_view_duration', function (Blueprint $table) {
            $table->integer('node_id');
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
        Schema::table('interactr_node_view_duration', function (Blueprint $table) {
            $table->dropColumn('node_id');
        });
    }
}
