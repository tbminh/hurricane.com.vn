<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role_accesses')->onDelete('cascade');

            $table->string('full_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
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
}
