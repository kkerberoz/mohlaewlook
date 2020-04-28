<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->string('user_id',11);
            $table->foreign('user_id')->references('user_id')->on('employees')->onUpdate('cascade');
            $table->date('work_date');
            $table->foreignId('flight_id')->references('flight_id')->on('flights')->onUpdate('cascade')->nullable();
            $table->enum('confirm_status',['free','confirm','cancel']);
            $table->primary(['user_id','work_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_schedules');
    }
}
