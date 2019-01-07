<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('notes')->nullable();
            $table->date('scheduled_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['active', 'canceled', 'completed', 'in_progress'])->default('active')->nullable();
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table){

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('appointment_type_id');

            $table->foreign('customer_id')->references('id')->on('third_parties');
            $table->foreign('doctor_id')->references('id')->on('third_parties');
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
