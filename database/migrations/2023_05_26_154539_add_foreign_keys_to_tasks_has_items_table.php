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
        Schema::table('tasks_has_items', function (Blueprint $table) {
            $table->foreign(['items_id'], 'fk_tasks_has_items_items1')->references(['id'])->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tasks_id'], 'fk_tasks_has_items_tasks1')->references(['id'])->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_has_items', function (Blueprint $table) {
            $table->dropForeign('fk_tasks_has_items_items1');
            $table->dropForeign('fk_tasks_has_items_tasks1');
        });
    }
};
