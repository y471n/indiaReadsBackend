<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('merchant_id')->on('merchant_details');
            $table->integer('inv_id')->unsigned()->default(101);
            $table->foreign('inv_id')->references('inv_id')->on('inventory_details');
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet');
            $table->float('selling_price')->default(0);
            $table->string('book_id');
            $table->foreign('book_id')->references('book_id')->on('book_library');
            $table->float('proc_price');
            $table->timestamp('when');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procurement_details');
    }
}
