<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsEligibleMagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_eligible_mag', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('company_details');
            $table->tinyInteger('is_enabled')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('is_eligible_mag');
    }
}
