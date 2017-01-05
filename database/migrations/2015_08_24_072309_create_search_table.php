<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('search', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->string('series', 300)->nullable();
            $table->string('vol', 100)->nullable();
            $table->string('contributor_name1', 255)->nullable();
            $table->text('contributor_name2')->nullable();
            $table->text('contributor_name3')->nullable();
            $table->string('product_form', 150)->nullable();
            $table->string('product_form_detail', 150)->nullable();
            $table->string('product_content', 100)->nullable();
            $table->string('page_no', 50)->nullable();
            $table->string('imprint_name', 250)->nullable();
            $table->string('publisher_name', 250)->nullable();
            $table->string('publication_place', 100)->nullable();
            $table->string('publisher_county', 100)->nullable();
            $table->string('text_language', 100)->nullable();
            $table->string('original_lang', 100)->nullable();
            $table->string('orig_lang_list', 200)->nullable();
            $table->string('end_category', 100)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->text('review')->nullable();
            $table->text('author_bio')->nullable();
            $table->text('table_content')->nullable();
            $table->string('prize', 300)->nullable();
            $table->string('publication_date', 100)->nullable();
            $table->string('publishing_status', 50)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('price', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('search');
    }
}
