<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResponderPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responder_patient', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('respondent_id');
            $table->integer('patient_id');
            $table->boolean('status');
            $table->double('lat');
            $table->double('lng');

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
        Schema::dropIfExists('responder_patient');
    }
}