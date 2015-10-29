<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostAttachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_att', function(Blueprint $table)
        {
            $table->increments('patId'); 
            $table->text('patAttatch');
            $table->integer('patNumber');
            $table->string('patToken', 255);
            $table->datetime('patDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_att');
        DB::table('post_att')->delete();
    }
}
