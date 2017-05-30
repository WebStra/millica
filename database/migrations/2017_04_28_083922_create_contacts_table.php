<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact',function(Blueprint $row){
            $row->increments('id');
            $row->string('name',255);
            $row->string('email',255);
            $row->string('phone',255);
            $row->text('subject');
            $row->tinyInteger('active')->default(1)->index();
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
       Schema::drop('contact');
    }
}
