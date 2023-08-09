<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interactr_element_clicks', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_element_impressions', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_impressions', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_node_interactions', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_node_view_duration', function (Blueprint $table) {
            $table->index('project_id');
            $table->index('node_id');
            $table->index(['project_id', 'node_id']);
        });
        Schema::table('interactr_project_view_duration', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_project_views', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_project_views_by_device', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_project_views_by_location', function (Blueprint $table) {
            $table->index('project_id');
        });
        Schema::table('interactr_surveys', function (Blueprint $table) {
            $table->index('project_id');
            $table->index('node_id');
            $table->index('element_id');
            $table->index(['project_id', 'node_id', 'element_id']);
            $table->index(['project_id', 'node_id']);
            $table->index(['project_id', 'element_id']);
            $table->index(['node_id', 'element_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
        Schema::table('interactr_media_views', function (Blueprint $table) {
            $table->index('media_id');
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
    }
}
