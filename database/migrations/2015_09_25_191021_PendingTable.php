<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendings', function(Blueprint $table)
        {
            $table->increments('pedId'); 
            $table->string('pedImg', 50);
            $table->string('pedName', 50);
            $table->integer('pedRanking');
            $table->integer('pedStateRanking');
            $table->float('pedSales');
            $table->datetime('pedCreatedAt');
            $table->datetime('pedUpdatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pendings');
        DB::table('pendings')->delete();
    }
}
