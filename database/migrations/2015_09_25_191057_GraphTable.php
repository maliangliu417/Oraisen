<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GraphTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphs', function(Blueprint $table)
        {
            $table->increments('grhId'); 
            $table->float('grhSales');
            $table->integer('grhVisitors');
            $table->integer('grhClicks');
            $table->float('grhEarnings');
            $table->datetime('grhCreatedAt');
            $table->datetime('grhUpdatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('graphs');
        DB::table('graphs')->delete();
    }
}
