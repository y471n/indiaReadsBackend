<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelfTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookshelf', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('item_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->string('contributor_name1', 255)->nullable();
            $table->float('init_pay')->default(0);
            $table->integer('shelf_type');
            $table->timestamp('when')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bookshelf');
    }
}
