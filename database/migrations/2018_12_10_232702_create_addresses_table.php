<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('address');

            $table->boolean('status')->nullable()->default(1);


            $table->timestamps();
        });

        Schema::table('addresses', function(Blueprint $table) {

            $table->unsignedInteger('third_party_id');

            $table->unsignedInteger('city_id');

            $table->foreign('third_party_id')->references('id')->on('third_parties');

            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
