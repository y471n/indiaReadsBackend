<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentCatsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parent_cats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('parent_id')->unique();
            $table->string('category');
            $table->integer('super_cat_id')->unsigned();
            $table->foreign('super_cat_id')->references('super_cat_id')->on('super_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('parent_cats');
    }
}
