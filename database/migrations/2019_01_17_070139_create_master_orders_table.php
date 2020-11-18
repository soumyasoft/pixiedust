<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('master_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_registrations');
            $table->string('bill_first_name', 255)->nullable();
            $table->string('bill_last_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('bill_phone_number', 255)->nullable();
            $table->string('user_password', 255)->nullable();
            $table->string('bill_address1', 255)->nullable();
            $table->string('bill_address2', 255)->nullable();
            $table->string('bill_city', 255)->nullable();
            $table->integer('bill_post_code')->nullable();
            $table->string('bill_state', 255)->nullable();
            $table->string('bill_country', 255)->nullable();
            $table->string('ship_full_name', 255)->nullable();
            $table->string('ship_phone_number', 255)->nullable();
            $table->string('ship_address1', 255)->nullable();
            $table->string('ship_address2', 255)->nullable();
            $table->string('ship_city', 255)->nullable();
            $table->string('ship_post_code', 255)->nullable();
            $table->string('ship_state', 255)->nullable();
            $table->string('ship_country', 255)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->tinyInteger('payment_status')->comment = '1=Paid,2=Unpaid';
            $table->tinyInteger('order_status')->comment = '1=Ship,2=Not Shipped';
            $table->date('shipping_date');
            $table->text('order_notes')->nullable();
            $table->string('shipping_url', 255)->nullable();
            $table->string('tracking_id', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('master_orders');
    }

}
