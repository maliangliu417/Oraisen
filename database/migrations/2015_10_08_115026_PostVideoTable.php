<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_vid', function(Blueprint $table)
        {
            $table->increments('pviId'); 
            $table->text('pviVideo');
            $table->integer('pviNumber');
            $table->string('pviToken', 255);
            $table->datetime('pviDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_vid');
        DB::table('post_vid')->delete();
    }
}
