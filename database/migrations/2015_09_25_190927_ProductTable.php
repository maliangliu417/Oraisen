<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('pdtId'); 
            $table->string('pdtImg', 50);
            $table->string('pdtName', 50);
            $table->text('pdtDescription');
            $table->float('pdtPrice');
            $table->float('pdtComission');
            $table->string('pdtToken', 255);
            $table->integer('pdtItemId');
            $table->string('pdtReferralId', 50);
            $table->integer('pdtType');
            $table->integer('pdtPostPermission');
            $table->string('pdtCategory', 50);
            $table->string('pdtAttribute', 50);
            $table->string('pdtTUrl', 50);
            $table->string('pdtPUrl', 50);
            $table->string('pdtCUrl', 50);
            $table->string('pdtZipcode', 10);
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
        Schema::drop('products');
        DB::table('products')->delete();
    }
}
