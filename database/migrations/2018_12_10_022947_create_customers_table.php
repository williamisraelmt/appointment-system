<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');

            $table->string('last_name');

            $table->string('born_date')->nullable();

            $table->string('identification_no')->unique();

            $table->enum('blood_type', ['O+', 'O-', 'A+', 'A-', 'AB+', 'AB-', 'B+', 'B-']);

            $table->enum('gender', ['m', 'f']);

            $table->boolean('status')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
