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
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('status_approval', 45)->nullable();
            $table->string('status_item', 45)->nullable();
            $table->string('item_name', 45)->nullable();
            $table->string('item_amount', 45)->nullable();
            $table->integer('users_id')->index('fk_reports_users1_idx');
            $table->date('start_date_pengadaan')->nullable();
            $table->integer('duration_pengadaan')->nullable();
            $table->date('end_date_pengadaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita_acaras');
    }
};
