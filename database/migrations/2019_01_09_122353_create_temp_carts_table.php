<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempCartsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('temp_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('user_id')->nullable();
            $table->string('session_id',255)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->decimal('total_shipping_price', 10, 2)->nullable();          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('temp_carts');
    }

}
