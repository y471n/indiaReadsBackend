<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_login', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('user_id')->unique();
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->string('hash')->nullable();
            $table->integer('user_status')->default(2);
            $table->string('salt')->nullable();
            $table->timestamps();
            $table->timestamp('verify');
            $table->tinyInteger('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_login');
    }
}
