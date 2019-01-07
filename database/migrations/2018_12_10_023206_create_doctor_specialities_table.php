<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_specialities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::table('doctor_specialities', function (Blueprint $table){
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('speciality_id');

            $table->foreign('doctor_id')->references('id')->on('third_parties');
            $table->foreign('speciality_id')->references('id')->on('specialities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_specialities');
    }
}
