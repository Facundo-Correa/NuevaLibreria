<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->json('cart')->nullable();
            $table->json('data')->nullable();
            $table->string('total')->nullable();
            $table->string('SessionID')->nullable();
            $table->string('UserId')->nullable();
            $table->string('payment')->nullable();

            $table->timestamps();
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
