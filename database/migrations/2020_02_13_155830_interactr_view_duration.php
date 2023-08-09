<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InteractrViewDuration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactr_node_view_duration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');

            $table->integer('project_id');
            $table->string('timestamp');
            $table->date('date');
            $table->bigInteger('count')->default(0);
        });

        Schema::create('interactr_project_view_duration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');

            $table->integer('project_id');
            $table->string('timestamp');
            $table->date('date');
            $table->bigInteger('count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interactr_node_view_duration');
        Schema::dropIfExists('interactr_project_view_duration');
    }
}
