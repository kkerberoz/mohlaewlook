<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->string('passenger_id',9)->unique();
            $table->string('passenger_title',10);
            $table->string('passenger_name',64);
            $table->string('passenger_surname',64);
            $table->date('passenger_DOB');
            $table->enum('gender',['male','female']);
            $table->string('passenger_nationality',60);
            $table->string('passenger_religion',20);
            $table->string('passenger_idcard',13)->nullable();
            $table->string('passenger_passport',13)->nullable();
            $table->string('passenger_phone',12)->nullable();
            $table->string('passenger_email',60);

            $table->primary('passenger_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
