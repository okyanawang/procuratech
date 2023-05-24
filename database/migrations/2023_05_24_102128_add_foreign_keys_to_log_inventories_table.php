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
        Schema::table('log_inventories', function (Blueprint $table) {
            $table->foreign(['inventories_id'], 'fk_log_inventories_inventories1')->references(['id'])->on('inventories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_inventories', function (Blueprint $table) {
            $table->dropForeign('fk_log_inventories_inventories1');
        });
    }
};
