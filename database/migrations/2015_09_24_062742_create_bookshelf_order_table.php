<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelfOrderTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookshelf_order', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('bookshelf_order_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->string('unique_book_id')->nullable();
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('order_status');
            $table->integer('inventory_id')->default(101);
            $table->float('mrp');
            $table->float('init_pay');
            $table->float('disc_pay');
            $table->float('amt_pay');
            $table->float('store_pay');
            $table->float('cost');
            $table->float('refund');
            $table->float('store_refund');
            $table->tinyInteger('refund_type')->default(1);
            $table->tinyInteger('refund_generate')->default(1);
            $table->timestamp('issue_date');
            $table->timestamp('expected_return_date')->nullable();
            $table->string('d_track_id')->nullable();
            $table->string('carrier')->nullable();
            $table->string('carrier_link')->nullable();
            $table->text('order_comments')->nullable();
            $table->text('pickup_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bookshelf_order');
    }
}
