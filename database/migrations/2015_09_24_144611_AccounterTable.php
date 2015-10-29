<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounter', function(Blueprint $table)
        {
            $table->increments('accId'); 
            $table->string('accRememberToken', 255);
            $table->string('accImgUrl', 150);
            $table->integer('accOverallRangking');
            $table->integer('accStateRangking');
            $table->integer('accGraphId');
            $table->integer('accProductId');
            $table->integer('accPostContentId');
            $table->integer('accPostImgId');
            $table->integer('accPostVideoId');
            $table->integer('accPostAttachId');
            $table->integer('accPostMapId');
            $table->text('accFriends');
            $table->text('accFavorites');
            $table->text('accUnFavorites');
            $table->text('accPendings');
            $table->datetime('accCreatedAt');
            $table->datetime('accUpdatedAt');
        });

        DB::table('accounter')->insert(
            [  
                [  
                    'accImgUrl' => 'images/oraisen.png',
                    'accRememberToken' => 'oraisenToken', 
                    'accCreatedAt'=> $date = date('Y-m-d H:i:s')], 
                        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounter');
        DB::table('accounter')->delete();
    }
}
