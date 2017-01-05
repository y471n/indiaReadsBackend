<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->bigInteger('magazine_id')->unique();
            $table->bigInteger('current_issue_id')->unique();
            $table->string('name')->unique();
            $table->string('currency');
            $table->float('price');
            $table->string('frequency');
            $table->integer('issues_per_year');
            $table->string('ratings');
            $table->string('ISSN');
            $table->integer('favorites')->nullable();
            $table->integer('sales_rank');
            $table->text('description');
            $table->text('url');
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
        Schema::drop('magazines');
    }
}
