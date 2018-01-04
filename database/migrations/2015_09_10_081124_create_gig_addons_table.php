<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gig_addons', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gig_id')->unsigned();
            $table->text('addon');
            $table->double('amount');
            $table->timestamps();

            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gig_addons');
    }
}
