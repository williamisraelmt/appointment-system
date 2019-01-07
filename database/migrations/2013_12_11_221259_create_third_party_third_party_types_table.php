<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdPartyThirdPartyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_party_third_party_types', function (Blueprint $table) {
            $table->unsignedInteger('third_party_id');
            $table->unsignedInteger('third_party_type_id');

            $table->foreign('third_party_id')->references('id')->on('third_parties');
            $table->foreign('third_party_type_id')->references('id')->on('third_party_types');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('third_party_third_party_types');
    }
}
