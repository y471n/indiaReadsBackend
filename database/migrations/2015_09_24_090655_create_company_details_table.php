<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('company_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('company_id')->unique();
            $table->string('company_name');
            $table->string('company_info');
            $table->string('company_logo');
            $table->string('company_url');
            $table->tinyInteger('corp_type')->default(1);
            $table->tinyInteger('rent_type')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('company_details');
    }
}
