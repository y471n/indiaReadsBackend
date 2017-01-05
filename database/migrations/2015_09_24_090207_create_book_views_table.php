<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookViewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('book_views', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->bigInteger('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('visitor_id')->on('user_tracking_details');
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('view_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('book_views');
    }
}
