<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_questions_answers', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('gig_question_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->string('answers', 255);
            $table->timestamps();

            $table->foreign('gig_question_id')->references('id')->on('gig_questions')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_questions_answers');
    }
}
