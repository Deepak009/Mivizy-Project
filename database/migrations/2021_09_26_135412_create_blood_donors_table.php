<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
			$table->string('gender')->nullable();
			$table->date('dob')->nullable();
			$table->unsignedInteger('weight_in_kgs');
            $table->string('blood_group')->index();
            $table->string('email')->index()->nullable();
            $table->string('mobile_number')->index();
            $table->string('address')->nullable();
            $table->string('pincode')->index()->nullable();
            $table->string('state')->index()->nullable();
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
        Schema::dropIfExists('blood_donors');
    }
}
