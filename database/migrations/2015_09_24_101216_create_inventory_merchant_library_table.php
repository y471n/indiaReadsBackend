<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryMerchantLibraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_merchant_library', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('merchant_id')->on('merchant_details');
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('count')->default(0);
            $table->float('supply_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory_merchant_library');
    }
}
