<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelfOrderDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookshelf_order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('p_order_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->integer('items_count');
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('order_address_id')->unsigned();
            $table->foreign('order_address_id')->references('address_book_id')->on('user_address_book');
            $table->integer('pick_address_id')->unsigned();
            $table->foreign('pick_address_id')->references('address_book_id')->on('user_address_book');
            $table->float('price')->default(0);
            $table->float('coupon_discount')->default(0);
            $table->float('store_discount')->default(0);
            $table->float('shipping_charge')->default(0);
            $table->float('cod_charge')->default(0);
            $table->float('net_pay')->default(0);
            $table->integer('coupon_code')->nullable();
            $table->tinyInteger('payment_option');
            $table->tinyInteger('payment_status');
            $table->bigInteger('response_code');
            $table->string('response_msg');
            $table->bigInteger('payment_id');
            $table->bigInteger('transation_id');
            $table->string('invoice')->nullable();
            $table->string('dispatch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bookshelf_order_details');
    }
}
