<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide', function (Blueprint $row) {
            $row->increments('id');
            $row->string('image', 255);
            $row->string('meta', 255);
            $row->tinyInteger('active')->dafault(1)->index();
            $row->timestamps();
        });

        Schema::create('slide_translation', function (Blueprint $row) {
            $row->increments('id');
            $row->unsignedInteger('slide_id');
            $row->unsignedInteger('language_id');
            $row->string('title',255);
            $row->string('subtitle');
            $row->foreign('slide_id')->references('id')->on('slide')->onDelete('cascade')->onUpdate('cascade');
            $row->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('slide');
       Schema::drop('slide_translation');
    }
}
