<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtesyCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courtesy_customer', function (Blueprint $table) {
            $table->unsignedInteger('customer_id')->unique();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedInteger('courtesy_id')->unique();
            $table->foreign('courtesy_id')->references('id')->on('courtesies');
            $table->unsignedInteger('event_id')->unique();
            $table->foreign('event_id')->references('id')->on('events');
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
