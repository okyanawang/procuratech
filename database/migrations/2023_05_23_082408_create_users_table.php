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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('username')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->integer('registration_number')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('availability_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
