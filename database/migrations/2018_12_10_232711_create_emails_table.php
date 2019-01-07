<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');

            $table->string('address');

            $table->boolean('status')->nullable()->default(1);

            $table->timestamps();
        });

        Schema::table('emails', function (Blueprint $table){

            $table->unsignedInteger('third_party_id');

            $table->foreign('third_party_id')->references('id')->on('third_parties');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
