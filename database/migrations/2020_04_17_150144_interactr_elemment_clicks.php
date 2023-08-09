<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InteractrElemmentClicks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactr_element_clicks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');

            $table->integer('project_id');
            $table->string('element_id');
            $table->string('node_id');
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
        Schema::dropIfExists('interactr_element_clicks');
    }
}
