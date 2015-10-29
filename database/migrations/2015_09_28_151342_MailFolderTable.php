<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailFolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_folders', function(Blueprint $table)
        {
            $table->increments('mfdId'); 
            $table->string('mfdName', 50);
            $table->text('mfdMailIds');
            $table->string('mfdOwnerEmail', 50);

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
        Schema::drop('mail_folders');
        DB::table('mail_folders')->delete();
    }
}
