<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InteractrViewsByLocationDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactr_project_views_by_device', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');

            $table->integer('project_id');

            $table->date('date');
            $table->bigInteger('mobile')->default(0);
            $table->bigInteger('desktop')->default(0);
        });

        Schema::create('interactr_project_views_by_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_key');
            $table->integer('project_id');
            $table->date('date');

            $table->string('country_code');
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
        Schema::dropIfExists('interactr_project_views_by_device');
        Schema::dropIfExists('interactr_project_views_by_location');
    }
}
