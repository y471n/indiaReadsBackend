<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelfOrderTrackingDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookshelf_order_tracking_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('bookshelf_order_id')->unsigned();
            $table->foreign('bookshelf_order_id')->references('bookshelf_order_id')->on('bookshelf_order');
            $table->timestamp('new_delivery');
            $table->timestamp('delivery_processing');
            $table->timestamp('dispatched');
            $table->timestamp('delivered');
            $table->timestamp('new_pickup');
            $table->timestamp('pickup_processing');
            $table->timestamp('req_to_courier');
            $table->timestamp('returned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bookshelf_order_tracking_details');
    }
}
