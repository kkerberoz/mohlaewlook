<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id('flight_id')->unique();
            $table->string('flight_no',6);
            $table->foreign('flight_no')->references('flight_no')->on('class_prices')->onUpdate('cascade');
            $table->string('depart_location',3);
            $table->foreign('depart_location')->references('airport_id')->on('airports')->onUpdate('cascade');
            $table->string('arrive_location',3);
            $table->foreign('arrive_location')->references('airport_id')->on('airports')->onUpdate('cascade');
            $table->dateTime('depart_datetime');
            $table->dateTime('arrive_datetime');
            $table->foreignId('aircraft_id')->references('aircraft_id')->on('aircrafts')->onUpdate('cascade');
            $table->dateTime('actual_depart')->nullable();
            $table->dateTime('actual_arrive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
