<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_content', function(Blueprint $table)
        {
            $table->increments('pcoId'); 
            $table->text('pcoContent');
            $table->integer('pcoNumber');
            $table->string('pcoToken', 255);
            $table->datetime('pcoDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_content');
        DB::table('post_content')->delete();
    }
}
