<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 13, 2);
            $table->integer('max_per_person')->nullable()->default(null);
            $table->integer('min_per_person')->nullable()->default(null);
            $table->integer('quantity_available')->nullable()->default(null);
            $table->integer('quantity_sold')->default(0);
            $table->dateTime('start_sale_date')->nullable();
            $table->dateTime('end_sale_date')->nullable();
            $table->decimal('sales_volume', 13, 2)->default(0);
            $table->decimal('organiser_fees_volume', 13, 2)->default(0);
            $table->tinyInteger('is_paused')->default(0);

            $table->enum('type',['simple','courtesy','expositor'])->default('simple');

            $table->unsignedInteger('event_id')->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->unsignedInteger('edited_by')->nullable();
            $table->foreign('edited_by')->references('id')->on('users');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
