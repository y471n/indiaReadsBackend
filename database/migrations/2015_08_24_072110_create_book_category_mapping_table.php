<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCategoryMappingTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('book_category_mapping', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unique();
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title', 255)->nullable();
            $table->string('contributor_name1', 255)->nullable();
            $table->integer('super_cat_id')->unsigned();
            $table->foreign('super_cat_id')->references('super_cat_id')->on('super_cats');
            $table->integer('parent_id')->unsigned();
            $table->foreign('parent_id')->references('parent_id')->on('parent_cats');
            $table->integer('cat1_id')->unsigned();
            $table->foreign('cat1_id')->references('cat1_id')->on('cats_level1');
            $table->integer('cat2_id')->unsigned();
            $table->foreign('cat2_id')->references('cat2_id')->on('cats_level2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('book_category_mapping');
    }
}
