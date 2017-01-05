<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('merchant_id')->unique();
            $table->string('merchant_name');
            $table->string('merchant_address');
            $table->bigInteger('merchant_phone');
            $table->timestamp('procurement_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('merchant_details');
    }
}
