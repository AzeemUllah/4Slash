<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gigs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 255);
            $table->integer('gigtype_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('slug', 255);
            $table->string('title', 255);
            $table->string('short_discription', 255);
            $table->text('discription');
            $table->integer('delivery_days');
            $table->double('price');
            $table->integer('views');
            $table->integer('sales');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gigs');
    }
}
