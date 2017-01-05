<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrowsingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browsing_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('ISBN13');
            $table->foreign('ISBN13')->references('ISBN13')->on('mastersheet');
            $table->string('cookie_id');
            $table->foreign('cookie_id')->references('cookie_id')->on('user_tracking_details');
            $table->string('title', 255)->nullable();
            $table->integer('count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('browsing_history');
    }
}
