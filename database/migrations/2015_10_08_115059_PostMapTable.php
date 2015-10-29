<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_map', function(Blueprint $table)
        {
            $table->increments('pmaId'); 
            $table->text('pmaMap');
            $table->integer('pmaNumber');
            $table->string('pmaToken', 255);
            $table->datetime('pmaDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_map');
        DB::table('post_map')->delete();
    }
}
