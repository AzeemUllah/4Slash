<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gig_questions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gig_id')->unsigned();
            $table->text('question');
            $table->text('answers');
            $table->string('type');
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
        Schema::drop('gig_questions');
    }
}
