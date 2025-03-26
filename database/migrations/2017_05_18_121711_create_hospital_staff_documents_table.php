
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalStaffDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_staff_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id')->unsigned()->index();

            $table->text('document_path')->nullable();

            $table->timestamps();


            $table->foreign('staff_id')
                ->references('id')->on('hospital_staffs')
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
        Schema::dropIfExists('hospital_staff_documents');
    }
}
