<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsLevel2Table extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cats_level2', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cat2_id')->unique();
            $table->string('category');
            $table->integer('cat1_id')->unsigned();
            $table->foreign('cat1_id')->references('cat1_id')->on('cats_level1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('cats_level2');
    }
}
