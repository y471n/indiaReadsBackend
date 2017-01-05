<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStoreCreditDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_store_credit_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->timestamp('when');
            $table->integer('why_id');
            $table->tinyInteger('why_name');
            $table->integer('p_order_id')->unsigned();
            $table->foreign('p_order_id')->references('p_order_id')->on('bookshelf_order_details');
            $table->float('store_credit')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('casual')->default(0);
            $table->integer('regular')->default(0);
            $table->integer('avid')->default(0);
            $table->integer('occasional')->default(0);
            $table->integer('corpotate')->default(0);
            $table->integer('logged_in')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_store_credit_details');
    }
}
