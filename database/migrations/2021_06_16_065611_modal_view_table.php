<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModalViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('interactr_modal_views')) {
            Schema::create('interactr_modal_views', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('api_key');

                $table->integer('modal_id');
                $table->integer('project_id');

                $table->date('date');
                $table->bigInteger('count')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('interactr_modal_views');
    }
}
