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
        Schema::create('log_inventories', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->integer('inventories_id')->index('fk_log_inventories_inventories1_idx');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_inventories');
    }
};
