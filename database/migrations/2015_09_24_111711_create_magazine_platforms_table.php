<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_platforms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->bigInteger('issue_id');
            $table->foreign('issue_id')->references('issue_id')->on('issues');
            $table->bigInteger('magazine_id');
            $table->foreign('magazine_id')->references('magazine_id')->on('magazines');
            $table->integer('dict_id')->unsigned();
            $table->foreign('dict_id')->references('dict_id')->on('dictionary');
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
        Schema::drop('magazine_platforms');
    }
}
