<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_parties', function (Blueprint $table) {

            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('identification_no')->nullable();
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('blood_type', ['O+', 'O-', 'A+', 'A-', 'AB+', 'AB-', 'B+', 'B-']);
            $table->boolean('removable')->default(1)->nullable();

            
            $table->date('born_date')->nullable();

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
        Schema::dropIfExists('third_parties');
    }
}
