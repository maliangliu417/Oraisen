<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostImgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_img', function(Blueprint $table)
        {
            $table->increments('pimId'); 
            $table->text('pimImg');
            $table->integer('pimNumber');
            $table->string('pimToken', 255);
            $table->datetime('pimDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_img');
        DB::table('post_img')->delete();
    }
}
