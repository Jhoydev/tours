<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsigniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insignia.clientes', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('key_app',128)->index();
            $table->string('database');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('web')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('avatar')->default('default.jpg');

            $table->softDeletes();
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
        Schema::dropIfExists('insignia.clientes');
    }
}
