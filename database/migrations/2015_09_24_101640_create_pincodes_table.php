<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pincodes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('pincode')->unique();
            $table->tinyInteger('cod')->default(0);
            $table->tinyInteger('online_delivery')->default(0);
            $table->tinyInteger('pickup')->default(0);
            // to be added to dictionary
            $table->tinyInteger('vendor_id')->default(0);
            $table->string('inv_id1');
            $table->string('inv_id2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pincodes');
    }
}
