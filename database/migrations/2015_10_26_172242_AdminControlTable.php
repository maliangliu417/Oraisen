<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function(Blueprint $table)
        {
            $table->increments('id'); 
            $table->string('email', 50);
            $table->string('password', 250);
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });

        DB::table('admin_users')->insert(
            [  
                [  
                        'email'=> 'daniels@gmail.com',   
                        'password'=> Hash::make('admin'), 
                        'created_at'=> $date = date('Y-m-d H:i:s')], 
                        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_users');
        DB::table('admin_users')->delete();
    }
}
