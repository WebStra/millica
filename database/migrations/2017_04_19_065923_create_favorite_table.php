<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite',function(Blueprint $row){
            $row->increments('id');
            $row->integer('product_id')->unsigned()->nullable();
            $row->integer('user_id');
            $row->tinyInteger('active')->dafault(1)->index();
            $row->timestamps();
            $row->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favorite');
    }
}
