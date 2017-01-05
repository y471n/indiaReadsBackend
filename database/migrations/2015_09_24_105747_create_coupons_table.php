<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('coupon_id')->unique();
            $table->string('coupon_code');
            $table->integer('coupon_use_count');
            $table->integer('user_use_count');
            $table->timestamp('start_date');
            $table->timestamp('expiry_date');
            $table->float('value');
            $table->tinyInteger('web')->default(0);
            $table->tinyInteger('app')->default(0);
            $table->tinyInteger('web_app')->default(0);
            // refrenced from affiliate table
            $table->tinyInteger('affiliate_id')->default(0);
            //refrenced from dictionary
            $table->tinyInteger('payment_mode_id')->default(0);
            $table->tinyInteger('condition_id');
            $table->tinyInteger('nature_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}
