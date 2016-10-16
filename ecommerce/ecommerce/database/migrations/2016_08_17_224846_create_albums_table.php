<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
  
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('category_id')->unsigned()->index();
             $table->string('name');
            $table->string('description');
            $table->string('thumbnail');
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('albums');
    }
}
