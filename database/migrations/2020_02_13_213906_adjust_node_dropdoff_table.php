<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustNodeDropdoffTable extends Migration
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
            $table->integer('10%')->default(0);
            $table->integer('20%')->default(0);
            $table->integer('30%')->default(0);
            $table->integer('40%')->default(0);
            $table->integer('50%')->default(0);
            $table->integer('60%')->default(0);
            $table->integer('70%')->default(0);
            $table->integer('80%')->default(0);
            $table->integer('90%')->default(0);
            $table->integer('100%')->default(0);
            $table->dropColumn('timestamp');
            $table->dropColumn('count');
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
            $table->dropColumn('10%');
            $table->dropColumn('20%');
            $table->dropColumn('30%');
            $table->dropColumn('40%');
            $table->dropColumn('50%');
            $table->dropColumn('60%');
            $table->dropColumn('70%');
            $table->dropColumn('80%');
            $table->dropColumn('90%');
            $table->dropColumn('100%');
            $table->string('timestamp');
            $table->integer('count');
        });
    }
}
