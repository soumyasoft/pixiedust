<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('discount');
            $table->decimal('discount_price', 10, 2);
            $table->decimal('shipping_price', 10, 2);
            $table->tinyInteger('best_seller');
            $table->string('image',255);
            $table->string('meta_title', 255);
            $table->string('meta_keywords', 255);
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('products');
    }

}
