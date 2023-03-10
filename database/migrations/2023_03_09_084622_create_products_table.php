<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->decimal('asking_price')->index();
            $table->decimal('current_bid_price')->index()->nullable();
            $table->string('sku')->index();
            $table->tinyInteger('status')->index()->nullable()->comment('status(live,closed)');
            $table->tinyInteger('type')->index()->default(0);
            $table->unsignedBigInteger('auction_id')->index()->nullable();
            $table->foreign('auction_id')->references('id')->on('auctions');
            $table->unsignedBigInteger('sub_category_id')->index();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->boolean('is_authenticated')->default(0);
            $table->unsignedBigInteger('seller_id')->index();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->string('issued_year');
            $table->boolean('is_featured')->default(0);
            $table->json('additional')->nullable();
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
        Schema::dropIfExists('products');
    }
}
