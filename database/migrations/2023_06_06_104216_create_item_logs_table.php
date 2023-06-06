<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_logs', function (Blueprint $table) {
            $table->id();
            $table->string('taskName')->default('');
            $table->bigInteger('items_id');
            $table->bigInteger('tasks_id')->nullable();
            $table->string('status');
            $table->float('stock', 10, 0)->default(0);
            $table->timestamps();

            // $table->foreign('items_id')->references('id')->on('items');
            // $table->foreign('tasks_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_logs');
    }
};
