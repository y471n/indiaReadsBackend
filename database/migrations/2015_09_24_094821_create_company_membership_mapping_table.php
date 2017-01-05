<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyMembershipMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_membership_mapping', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('company_details');
            $table->integer('membership_id')->unsigned();
            $table->foreign('membership_id')->references('membership_id')->on('company_membership_info');
            $table->timestamp('start_date');
            $table->timestamp('expiry_date');
            $table->integer('total_delivery');
            $table->integer('current_delivery');
            $table->tinyInteger('membership_status')->default(1);
            $table->tinyInteger('delivery_address')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_membership_mapping');
    }
}
