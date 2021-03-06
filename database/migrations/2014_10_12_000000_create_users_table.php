<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->boolean('status')->nullable()->default(1);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table){

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
        Schema::dropIfExists('users');
    }
}
