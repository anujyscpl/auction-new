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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('phone_number')->unique();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->boolean('is_verified')->index()->default(1);
            $table->string('password');
            $table->string('api_access_token')->nullable();
            $table->boolean('status')->index()->default(1);
            $table->boolean('is_suspended')->index()->default(0);
            $table->json('additional')->nullable();
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
