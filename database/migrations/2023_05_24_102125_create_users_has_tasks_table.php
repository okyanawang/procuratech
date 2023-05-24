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
        Schema::create('users_has_tasks', function (Blueprint $table) {
            $table->integer('users_id')->index('fk_users_has_tasks_users1_idx');
            $table->integer('tasks_id')->index('fk_users_has_tasks_tasks1_idx');

            $table->primary(['users_id', 'tasks_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_tasks');
    }
};
