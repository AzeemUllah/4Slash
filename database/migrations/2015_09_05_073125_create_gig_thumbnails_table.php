<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gig_thumbnails', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gig_id')->unsigned();
            $table->string('thumbnail', 255);

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
        //
    }
}
