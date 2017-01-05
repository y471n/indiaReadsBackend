<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubMastersheetTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sub_mastersheet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->string('series', 300)->nullable();
            $table->string('vol', 100)->nullable();
            $table->string('contributor_grp1', 100)->nullable();
            $table->string('contributor_name1', 255)->nullable();
            $table->string('contributor_grp2', 100)->nullable();
            $table->text('contributor_name2')->nullable();
            $table->string('contributor_grp3', 100)->nullable();
            $table->text('contributor_name3')->nullable();
            $table->string('height', 4)->nullable();
            $table->string('width', 4)->nullable();
            $table->string('spine', 4)->nullable();
            $table->string('weight', 8)->nullable();
            $table->string('short_edition', 150)->nullable();
            $table->string('product_form', 150)->nullable();
            $table->string('product_form_detail', 150)->nullable();
            $table->string('product_content', 100)->nullable();
            $table->string('page_no', 50)->nullable();
            $table->string('illustration', 400)->nullable();
            $table->text('contained_items')->nullable();
            $table->string('imprint_name', 250)->nullable();
            $table->string('publisher_name', 250)->nullable();
            $table->string('publication_place', 100)->nullable();
            $table->string('publisher_county', 100)->nullable();
            $table->string('text_language', 100)->nullable();
            $table->string('original_lang', 100)->nullable();
            $table->string('orig_lang_list', 200)->nullable();
            $table->string('N_audience_grp', 50)->nullable();
            $table->string('O_audience_grp', 80)->nullable();
            $table->string('interest_age', 60)->nullable();
            $table->string('reading_age', 60)->nullable();
            $table->string('BIC_subject', 100)->nullable();
            $table->string('BIC_qualifier', 100)->nullable();
            $table->string('category', 130)->nullable();
            $table->string('end_category', 100)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->text('review')->nullable();
            $table->text('author_bio')->nullable();
            $table->text('table_content')->nullable();
            $table->string('prod_website_url', 300)->nullable();
            $table->string('prod_website_code', 2)->nullable();
            $table->string('prod_website_type', 150)->nullable();
            $table->string('replaces_isbn', 13)->nullable();
            $table->string('replaces_by_isbn', 13)->nullable();
            $table->string('alt_isbn', 13)->nullable();
            $table->string('render_isbn', 13)->nullable();
            $table->string('base_isbn', 13)->nullable();
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
        Schema::drop('sub_mastersheet');
    }
}
