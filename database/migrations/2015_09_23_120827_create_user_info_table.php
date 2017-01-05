<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_info', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('alternate_email')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobile')->nullable();
            $table->tinyInteger('profile_pic')->default(0);
            $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_info');
    }
}
