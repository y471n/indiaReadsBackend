<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyMembershipInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_membership_info', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('membership_id')->unique();
            $table->tinyInteger('membership_type');
            $table->integer('delivery_book_count');
            $table->integer('cost_per_book')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_membership_info');
    }
}
