<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorNonWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_non_working_days', function (Blueprint $table) {
            $table->increments('id');
            $table->date('non_working_date');
            $table->timestamps();
        });

        Schema::table('doctor_non_working_days', function (Blueprint $table){
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('third_parties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_non_working_days');
    }
}
