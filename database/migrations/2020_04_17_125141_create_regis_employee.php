<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 11)->unique(); //PK
            $table->string('username', 32)->unique();
            $table->string('password', 32);
            $table->string('title', 10);
            $table->string('name', 64);
            $table->string('surname', 64);
            $table->enum('gender', ['male', 'female']);
            $table->string('id_card', 13);
            $table->date('DOB');
            $table->double('height');
            $table->double('weight');
            $table->string('email', 60)->nullable();
            $table->string('phone', 10);
            $table->string('address', 128);
            $table->date('start_date');
            $table->double('salary');
            $table->enum('employee_role', ['flight_manager', 'human_resource', 'staff', 'pilot', 'flight_attendant']);
            $table->string('airport_id', 3);
            $table->foreign('airport_id')->references('airport_id')->on('airports')->onUpdate('cascade'); //FK
            $table->unsignedInteger('is_work');

            // $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
