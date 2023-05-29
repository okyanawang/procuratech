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
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign(['tasks_id'], 'fk_reports_tasks1')->references(['id'])->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['users_id'], 'fk_reports_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('fk_reports_tasks1');
            $table->dropForeign('fk_reports_users1');
        });
    }
};
