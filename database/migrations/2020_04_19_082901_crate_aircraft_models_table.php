<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateAircraftModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft_models', function (Blueprint $table) {
            $table->id('model_id')->unique();
            $table->string('model_name',20);
            $table->double('fuel_capacity');
            $table->unsignedInteger('number_of_engine');
            $table->string('engine_type',64);
            $table->unsignedInteger('eco_cap');
            $table->unsignedInteger('bus_cap');
            $table->unsignedInteger('first_cap');
            $table->string('eco_pattern');
            $table->string('bus_pattern');
            $table->string('first_pattern');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aircraft_models');
    }
}
