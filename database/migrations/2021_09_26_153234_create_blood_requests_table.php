<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->string('blood_group')->index();
            $table->unsignedSmallInteger('number_of_unit');
            $table->string('mobile_number')->index();
			$table->string('patient_name')->index();
			$table->unsignedSmallInteger('patient_age')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('purpose')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->index()->nullable();
            $table->string('pincode')->index()->nullable();
			$table->unsignedBigInteger('user_id')->nullable()
					->constrained()
					->onUpdate('cascade')
      				->onDelete('cascade');
			$table->text('note')->nullable();
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
        Schema::dropIfExists('blood_requests');
    }
}
