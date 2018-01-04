<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 255)->unique();
            $table->string('order_no', 255)->unique();
            $table->integer('gig_id')->unsigned();
            $table->integer('gig_owner_id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name', 255);
            $table->string('company_tagline', 255);
            $table->string('company_industry', 255);
            $table->text('company_discription');
            $table->string('status', 255)->default('pending');
            $table->timestamps();
            $table->timestamp('expiry');

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
        Schema::drop('orders');
    }
}
