<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addons', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('addon_id');
            $table->integer('quantity');
            $table->float('total_amount');

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
        Schema::drop('order_addons');
    }
}
