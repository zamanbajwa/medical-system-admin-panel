<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('insurance_id')->unsigned()->index();
            $table->string('document_path')->nullable();
            $table->timestamps();

            $table->foreign('insurance_id')
                ->references('id')->on('insurances')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance_documents');
    }
}
