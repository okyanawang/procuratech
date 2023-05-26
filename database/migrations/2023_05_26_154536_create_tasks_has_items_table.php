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
        Schema::create('tasks_has_items', function (Blueprint $table) {
            $table->integer('tasks_id')->index('fk_tasks_has_items_tasks1_idx');
            $table->integer('items_id')->index('fk_tasks_has_items_items1_idx');
            $table->float('amount', 10, 0)->nullable();

            $table->primary(['tasks_id', 'items_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_has_items');
    }
};
