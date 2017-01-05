<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressBookTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_address_book', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('address_book_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->string('fullname')->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_address_book');
    }
}
