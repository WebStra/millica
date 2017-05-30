<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(0)->index();
            $row->timestamps();
        });

        Schema::create('sizes_translation', function (Blueprint $row) {
            $row->increments('id');
            $row->unsignedInteger('sizes_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('sizes_id')->references('id')->on('sizes')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('colors', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(0)->index();
            $row->timestamps();
        });

        Schema::create('colors_translation', function (Blueprint $row) {
            $row->increments('id');
            $row->unsignedInteger('colors_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('colors_id')->references('id')->on('colors')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('seasons', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(0)->index();
            $row->timestamps();
        });

        Schema::create('seasons_translation', function (Blueprint $row) {
            $row->increments('id');
            $row->unsignedInteger('seasons_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('seasons_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('addition', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(0)->index();
            $row->timestamps();
        });

        Schema::create('addition_translation', function (Blueprint $row) {
            $row->increments('id');
            $row->unsignedInteger('addition_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->foreign('addition_id')->references('id')->on('addition')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('sizes');
        Schema::drop('sizes_translation');
        Schema::drop('colors');
        Schema::drop('colors_translation');
        Schema::drop('seasons');
        Schema::drop('seasons_translation');
        Schema::drop('addition');
        Schema::drop('addition_translation');
    }
}
