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
        Schema::create('interactr_upload_storage', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->integer('project_id');
            $table->date('date');
            $table->integer('user_id');
            $table->string('media_id');
            $table->unsignedFloat('storage_used', 10, 2)->default(0); // storage size in KB
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interactr_upload_storage');
    }
};
