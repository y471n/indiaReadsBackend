<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLibraryTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('book_library', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('book_id')->unique();
            $table->primary('book_id');
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet')->onDelete('cascade')->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->integer('inv_id')->unsigned()->default(101);
            $table->foreign('inv_id')->references('inv_id')->on('inventory_details');
            $table->string('shelf_location');
            $table->float('proc_price');
            $table->integer('circulation');
            $table->float('copy_discount')->default(0);
            $table->tinyInteger('status');
            $table->timestamp('last_circulated_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('book_library');
    }
}
