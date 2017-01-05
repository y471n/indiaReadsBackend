<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserShelfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shelf', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user_login');
            $table->bigInteger('zinio_user_id');
            $table->foreign('zinio_user_id')->references('zinio_user_id')->on('user_zinio');
            $table->bigInteger('issue_id');
            $table->foreign('issue_id')->references('issue_id')->on('issues');
            $table->bigInteger('magazine_id');
            $table->foreign('magazine_id')->references('magazine_id')->on('magazines');
            $table->tinyInteger('is_reading')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_shelf');
    }
}
