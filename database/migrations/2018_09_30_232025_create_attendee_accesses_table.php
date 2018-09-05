<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',128)->unique();
            $table->string('password');
            $table->unsignedInteger('attendee_id');
            $table->foreign('attendee_id')->references('id')->on('attendees');
            $table->rememberToken();
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
        Schema::dropIfExists('attendee_accesses');
    }
}
