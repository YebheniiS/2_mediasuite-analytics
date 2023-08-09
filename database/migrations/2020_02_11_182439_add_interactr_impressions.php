<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInteractrImpressions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactr_impressions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');

            $table->integer('project_id');

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
        Schema::dropIfExists('interactr_impressions');
    }
}
