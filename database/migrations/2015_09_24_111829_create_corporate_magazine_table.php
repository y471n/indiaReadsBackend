<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateMagazineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_magazine', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('company_details');
            $table->bigInteger('magazine_id');
            $table->foreign('magazine_id')->references('magazine_id')->on('magazines');
            $table->tinyInteger('is_enabled');
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
        Schema::drop('corporate_magazine');
    }
}
