<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function(Blueprint $table)
        {
            $table->increments('malId'); 
            $table->string('malSubject', 150);
            $table->text('malContent');
            $table->integer('malType');
            $table->integer('malRead');
            $table->integer('malImportant');
            $table->string('malFrom', 255);
            $table->string('malTo', 255);
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
        Schema::drop('mails');
        DB::table('mails')->delete();
    }
}
