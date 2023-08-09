<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactr_streaming_mins', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->integer('project_id');
            $table->date('date');
            $table->integer('user_id');
            $table->string('node_id');
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
        Schema::dropIfExists('interactr_streaming_mins');
    }
};
