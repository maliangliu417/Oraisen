<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FriendRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_request', function(Blueprint $table)
        {
            $table->increments('freId'); 
            $table->string('freFromToken', 255);
            $table->string('freToToken', 255);
            $table->integer('freStatus');
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('friend_request');
        DB::table('friend_request')->delete();
    }
}
