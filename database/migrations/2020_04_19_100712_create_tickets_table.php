<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('ticket_id')->unique();
            $table->string('seat_no');
            $table->enum('class_name',['economy','business','first']);
            $table->foreignId('flight_id')->references('flight_id')->on('flights')->onUpdate('cascade');
            $table->foreignId('reservation_id')->references('reservation_id')->on('reservations')->onUpdate('cascade');
            $table->string('passenger_id');
            $table->foreign('passenger_id')->references('passenger_id')->on('passengers')->onUpdate('cascade');
            $table->timestamp('checkin_time')->nullable();
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
