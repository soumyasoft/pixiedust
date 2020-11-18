<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon_code',255)->nullable();
            $table->integer('discount_percentage');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->comment = '1=Active,2=InActive';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('coupon_codes');
    }

}
