<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id('education_id')->unique();
            $table->string('user_id',11);
            $table->foreign('user_id')->references('user_id')->on('employees')->onUpdate('cascade');
            $table->string('degree',128);
            $table->string('university',128);
            $table->string('faculty',128);
            $table->string('department',128);
            $table->double('GPA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educations');
    }
}
