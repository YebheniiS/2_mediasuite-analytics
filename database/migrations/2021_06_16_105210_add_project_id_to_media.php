<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectIdToMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interactr_media_views', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('interactr_media_views', 'project_id')) {
                $table->integer('project_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interactr_media_views', function (Blueprint $table) {
            //
            $table->dropColumn('project_id');
        });
    }
}
