<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Commented out by MagicPalm 03/15/2023
        
        // DB::statement('ALTER TABLE `interactr_element_clicks` CHANGE COLUMN `element_id` `element_id` int(11) NULL DEFAULT NULL;');
        // DB::statement('ALTER TABLE `interactr_element_clicks` CHANGE COLUMN `node_id` `node_id` int(11) NULL DEFAULT NULL;');
        // Schema::table('interactr_element_clicks', function (Blueprint $table) {
        //     $table->index('element_id');
        //     $table->index('node_id');
        //     $table->index(['project_id', 'element_id', 'node_id'], 'iec_project_id_element_id_node_id_index');
        //     $table->index(['project_id', 'element_id']);
        //     $table->index(['project_id', 'node_id']);
        //     $table->index(['element_id', 'node_id']);
        //     $table->index('interaction_id');
        //     $table->index('modal_element_id');
        // });
        // //
        // DB::statement('ALTER TABLE `interactr_element_impressions` CHANGE COLUMN `element_id` `element_id` int(11) NULL DEFAULT NULL;');
        // DB::statement('ALTER TABLE `interactr_element_impressions` CHANGE COLUMN `node_id` `node_id` int(11) NULL DEFAULT NULL;');
        // Schema::table('interactr_element_impressions', function (Blueprint $table) {
        //     $table->index('element_id');
        //     $table->index('node_id');
        //     $table->index(['project_id', 'element_id', 'node_id'], 'iei_project_id_element_id_node_id_index');
        //     $table->index(['project_id', 'element_id']);
        //     $table->index(['project_id', 'node_id']);
        //     $table->index(['element_id', 'node_id']);
        //     $table->index('interaction_id');
        //     $table->index('modal_element_id');
        // });
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
