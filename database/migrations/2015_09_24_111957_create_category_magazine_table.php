<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryMagazineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_magazine', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories_magazine');
            $table->bigInteger('magazine_id');
            $table->foreign('magazine_id')->references('magazine_id')->on('magazines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_magazine');
    }
}
