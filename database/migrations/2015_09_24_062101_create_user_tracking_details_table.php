<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrackingDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_tracking_details', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->bigIncrements('visitor_id')->unique();
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->string('cookie_id')->unique();
            $table->string('browser_type')->nullable();
            $table->string('browser_version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_tracking_details');
    }
}
