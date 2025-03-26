<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_history_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_history_id')->unsigned()->index();
            $table->string('document_path')->nullable();
            $table->timestamps();

            $table->foreign('medical_history_id')
                ->references('id')->on('medical_history')
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
        Schema::dropIfExists('medical_history_documents');
    }
}
