<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_discount', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('company_details');
            $table->float('discount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('additional_discount');
    }
}
