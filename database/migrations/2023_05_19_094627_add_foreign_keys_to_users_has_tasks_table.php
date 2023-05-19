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
        Schema::table('users_has_tasks', function (Blueprint $table) {
            $table->foreign(['users_id'], 'fk_users_has_tasks_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tasks_id'], 'fk_users_has_tasks_tasks1')->references(['id'])->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_has_tasks', function (Blueprint $table) {
            $table->dropForeign('fk_users_has_tasks_users1');
            $table->dropForeign('fk_users_has_tasks_tasks1');
        });
    }
};
