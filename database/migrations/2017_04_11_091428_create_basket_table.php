<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket',function(Blueprint $row){
            $row->increments('id');
            $row->integer('product_id')->unsigned()->nullable();
            $row->integer('user_id');
            $row->integer('quantity');
            $row->string('size',255);
            $row->string('color');
            $row->double('price');
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
            $row->foreign('product_id')->references('id')->on('product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('basket');
    }
}
