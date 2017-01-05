<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelfParentOrderTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookshelf_parent_order', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('p_order_id')->unsigned();
            $table->foreign('p_order_id')->references('p_order_id')->on('bookshelf_order_details');
            $table->integer('bookshelf_order_id')->unsigned();
            $table->foreign('bookshelf_order_id')->references('bookshelf_order_id')->on('bookshelf_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bookshelf_parent_order');
    }
}
