<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function(Blueprint $table)
        {
            $table->increments('rfrId'); 
            $table->string('rfrName', 50);
            $table->float('rfrSales');
            $table->float('rfrEarned');
            $table->datetime('rfrCreatedAt');
            $table->datetime('rfrUpdatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('referrals');
        DB::table('referrals')->delete();
    }
}
