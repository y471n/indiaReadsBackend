<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryMerchantMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_merchant_mapping', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('inv_id')->unsigned();
            $table->foreign('inv_id')->references('inv_id')->on('inventory_details');
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('merchant_id')->on('merchant_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory_merchant_mapping');
    }
}
