<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAircraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->id('aircraft_id')->unique();
            $table->foreignId('brand_id')->references('brand_id')->on('aircraft_brands')->onUpdate('cascade');
            $table->foreignId('model_id')->references('model_id')->on('aircraft_models')->onUpdate('cascade');
            $table->date('aircraft_startdate');
            $table->date('aircraft_expired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aircrafts');
    }
}
