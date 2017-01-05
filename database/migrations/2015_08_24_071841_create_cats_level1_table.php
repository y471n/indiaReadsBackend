<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsLevel1Table extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cats_level1', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cat1_id')->unique();
            $table->string('category');
            $table->integer('parent_id')->unsigned();
            $table->foreign('parent_id')->references('parent_id')->on('parent_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('cats_level1');
    }
}
