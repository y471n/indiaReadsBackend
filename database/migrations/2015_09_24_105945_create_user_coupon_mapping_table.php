<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCouponMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coupon_mapping', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->integer('p_order_id')->unsigned();
            $table->foreign('p_order_id')->references('p_order_id')->on('bookshelf_order_details');
            $table->integer('coupon_id')->unsigned();
            $table->foreign('coupon_id')->references('coupon_id')->on('coupons');
            $table->timestamp('when')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_coupon_mapping');
    }
}
