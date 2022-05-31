<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('No Name');
            $table->string('status');
            $table->string('email')->unique()->nullable();
            $table->string('country_code', 10)->index()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('doctors');
    }
}
