<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteadminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteadmin_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id')->unique();
            $table->string('email_address');
            $table->string('password');
            $table->string('salt');
            $table->timestamp('last_seen')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('siteadmin_users');
    }
}
