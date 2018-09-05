<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document')->nullable();
            $table->string('email', 128)->unique();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('profession')->nullable();
            $table->string('workplace')->nullable();
            $table->string('password')->default(bcrypt('evento' . date("Y")));

            $table->unsignedInteger('edited_by')->nullable();
            $table->foreign('edited_by')->references('id')->on('users');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('attendees');
    }

}
