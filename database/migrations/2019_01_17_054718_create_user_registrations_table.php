<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegistrationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->increments('id');
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
            $table->tinyInteger('same_for_billing')->nullable();
            $table->tinyInteger('user_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_registrations');
    }

}
