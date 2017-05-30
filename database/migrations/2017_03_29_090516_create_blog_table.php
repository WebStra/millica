<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog',function (Blueprint $row){
           $row->increments('id');
           $row->string('image',255);
            $row->string('author',255);
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
        });

        Schema::create('blog_translation',function (Blueprint $row){
           $row->increments('id');
            $row->string('title',255);
            $row->text('body');
            $row->unsignedInteger('blog_id');
            $row->unsignedInteger('language_id');
            $row->foreign('blog_id')->references('id')->on('blog')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog');
        Schema::drop('blog_translation');
    }
}
