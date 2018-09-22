<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->boolean('available')->default(true);
            $table->string('code')->unique();
            $table->decimal('price', 13, 2);
            $table->boolean('complete')->default(false);
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
        Schema::dropIfExists('order_details');
    }
}
