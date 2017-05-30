<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comand',function(Blueprint $row){
           $row->increments('id');
            $row->integer('user');
            $row->string('delname',255);
            $row->string('delphone',255);
            $row->string('deladress',255);
            $row->string('deljudet',255);
            $row->string('dellocation',255);
            $row->string('facname',255);
            $row->string('facphone',255);
            $row->string('facadress',255);
            $row->string('facjudet',255);
            $row->string('faclocation',255);
            $row->string('payment',255);
            $row->string('contname',255);
            $row->string('contphone',255);
            $row->tinyInteger('active')->default(0)->index();
            $row->string('confirm_code',255);
            $row->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comand');
    }
}
