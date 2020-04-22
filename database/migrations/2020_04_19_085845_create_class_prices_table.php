<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_prices', function (Blueprint $table) {
            $table->string('flight_no',6)->unique();
            $table->double('eco_price');
            $table->double('bus_price');
            $table->double('first_price');

            $table->primary('flight_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_prices');
    }
}
