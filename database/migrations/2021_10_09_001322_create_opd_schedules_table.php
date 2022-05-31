<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPDSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_schedules', function (Blueprint $table) {
            $table->id();
			$table->foreignId('opd_category_id')
					->constrained()
					->onUpdate('cascade')
      				->onDelete('cascade');
            $table->string('doctor_name')->index();
            $table->string('gender')->nullable();
            $table->string('doctor_qualifications')->nullable();
            $table->string('address')->nullable();
			$table->string('pincode')->index()->nullable();
            $table->string('state')->index()->nullable();
            $table->string('hospital_name')->index()->nullable();
            $table->string('contact_number_1')->index()->nullable();
            $table->string('contact_number_2')->index()->nullable();
            $table->json('schedules')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opd_schedules');
    }
}
