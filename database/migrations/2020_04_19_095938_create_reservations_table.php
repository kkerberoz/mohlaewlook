<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id')->unique();
            $table->string('user_id',11);
            $table->foreign('user_id')->references('user_id')->on('customers')->onUpdate('cascade');
            $table->timestamp('reservation_datetime');
            $table->enum('reservation_status',['confirm','cancel','changed']);
            $table->bigInteger('reservation_changed_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
