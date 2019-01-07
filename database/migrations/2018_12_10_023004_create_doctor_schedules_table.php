<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('max_patients')->nullable();
            $table->integer('day_of_week');
            $table->timestamps();
        });

        Schema::table('doctor_schedules', function (Blueprint $table){

            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('room_id');
            $table->foreign('doctor_id')->references('id')->on('third_parties');
            $table->foreign('room_id')->references('id')->on('rooms');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_schedules');
    }
}
