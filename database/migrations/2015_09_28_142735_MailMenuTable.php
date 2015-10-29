<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_menu', function(Blueprint $table)
        {
            $table->increments('mmuId'); 
            $table->integer('mmuInbox');
            $table->integer('mmuDraft');
            $table->integer('mmuSent');
            $table->integer('mmuTrash');
            $table->integer('mmuSpam');
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
        Schema::drop('mail_menu');
        DB::table('mail_menu')->delete();
    }
}
