<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('inventory_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('inv_id')->unique();
            $table->string('inv_name');
            $table->string('inv_address');
            $table->bigInteger('inv_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('inventory_details');
    }
}
