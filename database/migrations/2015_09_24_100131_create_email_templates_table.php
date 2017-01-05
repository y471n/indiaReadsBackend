<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('company_details');
            $table->tinyInteger('type')->default(1);
            $table->text('verification_email');
            $table->text('book_holder');
            $table->text('promotion_email');
            $table->text('information_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('email_templates');
    }
}
