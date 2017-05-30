<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category',function (Blueprint $row){
           $row->increments('id');
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
        });

        Schema::create('category_translation',function (Blueprint $row){
           $row->increments('id');
            $row->unsignedInteger('category_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('category_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('colection',function (Blueprint $row){
           $row->increments('id');
            $row->string('image',255);
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
        });

        Schema::create('colection_translation',function (Blueprint $row){
            $row->increments('id');
            $row->unsignedInteger('colection_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('colection_id')->references('id')->on('colection')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('product',function (Blueprint $row){
            $row->increments('id');
            $row->integer('quantity');
            $row->tinyInteger('sale')->default(0)->index();
            $row->float('old_price');
            $row->float('price');
            $row->tinyInteger('active')->default(1)->index();
            $row->integer('category_id')->unsigned()->nullable();
            $row->tinyInteger('colection')->default(0)->index();
            $row->integer('colection_id');
            $row->timestamps();
            $row->foreign('category_id')->references('id')->on('category')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('product_translation',function (Blueprint $row){
            $row->increments('id');
            $row->unsignedInteger('product_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->text('body');
            $row->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('category');
        Schema::drop('category_translation');
        Schema::drop('colection');
        Schema::drop('colection_translation');
        Schema::drop('product');
        Schema::drop('product_translation');
    }
}
