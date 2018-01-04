<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteGigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_gigs', function(Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('gig_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')->onCascade('delete');
            $table->foreign('gig_id')->references('id')->on('gigs')->onCascade('delete');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favourite_gigs');
    }
}
