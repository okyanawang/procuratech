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
        Schema::table('users_has_projects', function (Blueprint $table) {
            $table->foreign(['projects_id'], 'fk_users_has_projects_projects1')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['users_id'], 'fk_users_has_projects_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_has_projects', function (Blueprint $table) {
            $table->dropForeign('fk_users_has_projects_projects1');
            $table->dropForeign('fk_users_has_projects_users1');
        });
    }
};