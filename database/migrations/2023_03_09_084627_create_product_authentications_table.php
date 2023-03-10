<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('product_authentications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authenticator_id')->index();
            $table->foreign('authenticator_id')->references('id')->on('authenticators');
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('grade');
            $table->unsignedBigInteger('created_by')->index();
            $table->foreign('created_by')->references('id')->on('admins');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_authentications');
    }
}
