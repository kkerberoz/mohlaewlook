<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id')->unique();
            $table->enum('payment_method',['MasterCard','VisaCard','Cash']);
            $table->string('payment_card',16)->nullable();
            $table->timestamp('payment_time');
            $table->double('total_price');
            $table->foreignId('reservation_id')->references('reservation_id')->on('reservations')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
