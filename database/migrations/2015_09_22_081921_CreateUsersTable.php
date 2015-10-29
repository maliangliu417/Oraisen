<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('usrId');   
            $table->string('usrFrsName', 50);
            $table->string('usrLstName', 50);
            $table->string('usrName', 50);
            $table->string('email', 50);   
            $table->string('usrPwd', 150);
            $table->string('usrPermission', 50);
            $table->string('usrCountry', 50);    
            $table->string('usrState', 50);
            $table->string('usrZipcode', 50);
            $table->string('usrGender', 25);
            $table->boolean('usrConfirmed')->default(0);
            $table->string('usrConfirmationCode')->nullable();
            $table->string('usrRememberToken', 255)->nullable();
            $table->string('usrType', 25);
            $table->biginteger('usrSocialId');
            $table->datetime('usrCreatedAt');
            $table->datetime('usrUpdatedAt');
        });

        DB::table('users')->insert(
            [  
                [  
                        'email'=> 'oraisen@gmail.com',   
                        'usrFrsName' => 'Oraisen',
                        'usrLstName' => 'Company',
                        'usrRememberToken' => 'oraisenToken', 
                        'usrCreatedAt'=> $date = date('Y-m-d H:i:s')], 
                        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        DB::table('users')->delete();
    }
}
