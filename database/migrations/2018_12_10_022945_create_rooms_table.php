<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            
            $table->string('phone')->nullable();

            $table->boolean('status')->default(1)->nullable();

            $table->timestamps();
        });

        Schema::table('rooms', function(Blueprint $table){

            $table->unsignedInteger('building_id');
            $table->foreign('building_id')->references('id')->on('buildings');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
